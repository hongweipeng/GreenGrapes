<?php
/**
 * 系列文章的与数据库的操作
 */
class MetasSeries extends Widget_Abstract_Metas {

    static $type = 'series';

    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault('ignore=0&current=');

        $select = $this->select()->where('type = ?', self::$type);
        if ($this->parameter->ignore) {
            $select->where('mid <> ?', $this->parameter->ignore);
        }

        $this->stack = $this->db->fetchAll($select->order('table.metas.order', Typecho_Db::SORT_ASC));
    }

    /**
     * 判断分类名称是否存在
     *
     * @access public
     * @param string $name 分类名称
     * @return boolean
     */
    public function nameExists($name)
    {
        $select = $this->db->select()
            ->from('table.metas')
            ->where('type = ?', self::$type)
            ->where('name = ?', $name)
            ->limit(1);

        if ($this->request->mid) {
            $select->where('mid <> ?', $this->request->mid);
        }

        $meta_series = $this->db->fetchRow($select);
        return $meta_series ? false : true;
    }

    /**
     * 判断分类是否存在
     *
     * @access public
     * @param integer $mid 分类主键
     * @return boolean
     */
    public function seriesExists($mid)
    {
        $category = $this->db->fetchRow($this->db->select()
            ->from('table.metas')
            ->where('type = ?', self::$type)
            ->where('mid = ?', $mid)->limit(1));

        return $category ? true : false;
    }

    /**
     * 判断分类名转换到缩略名后是否合法
     *
     * @access public
     * @param string $name 分类名
     * @return boolean
     */
    public function nameToSlug($name)
    {
        if (empty($this->request->slug)) {
            $slug = Typecho_Common::slugName($name);
            if (empty($slug) || !$this->slugExists($name)) {
                return false;
            }
        }

        return true;
    }

    /**
     * 判断分类缩略名是否存在
     *
     * @access public
     * @param string $slug 缩略名
     * @return boolean
     */
    public function slugExists($slug)
    {
        $select = $this->db->select()
            ->from('table.metas')
            ->where('type = ?', self::$type)
            ->where('slug = ?', Typecho_Common::slugName($slug))
            ->limit(1);

        if ($this->request->mid) {
            $select->where('mid <> ?', $this->request->mid);
        }

        $meta_series = $this->db->fetchRow($select);
        return $meta_series ? false : true;
    }

    /**
     * 生成表单
     *
     * @access public
     * @param string $action 表单动作
     * @return Typecho_Widget_Helper_Form_Element
     */
    public function form($action = NULL)
    {
        if ($action == NULL) {
            $action_do = isset($this->request->mid) ? 'update' : 'insert';
        }else {
            $action_do = '';
        }

        /** 构建表格 */
        $form = new Typecho_Widget_Helper_Form($this->security->getIndex('/action/post_series?do=' . $action_do),
            Typecho_Widget_Helper_Form::POST_METHOD);

        /** 专题名称 */
        $name = new Typecho_Widget_Helper_Form_Element_Text('name', NULL, NULL, _t('专题名称 *'));
        $form->addInput($name);

        /** 专题缩略名 */
        $slug = new Typecho_Widget_Helper_Form_Element_Text('slug', NULL, NULL, _t('专题缩略名'),
            _t('专题缩略名用于创建友好的链接形式, 建议使用字母, 数字, 下划线和横杠.'));
        $form->addInput($slug);

        /** 父级专题 */
        /*$options = array(0 => _t('不选择'));
        $parents = $this->widget('Widget_Metas_Category_List@options',
            (isset($this->request->mid) ? 'ignore=' . $this->request->mid : ''));

        while ($parents->next()) {
            $options[$parents->mid] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parents->levels) . $parents->name;
        }

        $parent = new Typecho_Widget_Helper_Form_Element_Select('parent', $options, $this->request->parent, _t('父级专题'),
            _t('此专题将归档在您选择的父级专题下.'));
        $form->addInput($parent);*/

        /** 专题描述 */
        $description =  new Typecho_Widget_Helper_Form_Element_Textarea('description', NULL, NULL,
            _t('专题描述'), _t('此文字用于描述专题, 在有的主题中它会被显示.'));
        $form->addInput($description);

        /** 专题动作 */
        $do = new Typecho_Widget_Helper_Form_Element_Hidden('do');
        $form->addInput($do);

        /** 专题主键 */
        $mid = new Typecho_Widget_Helper_Form_Element_Hidden('mid');
        $form->addInput($mid);

        /** 提交按钮 */
        $submit = new Typecho_Widget_Helper_Form_Element_Submit();
        $submit->input->setAttribute('class', 'btn primary');
        $form->addItem($submit);

        if (isset($this->request->mid) && 'insert' != $action) {
            /** 更新模式 */
            $meta = $this->db->fetchRow($this->select()
                ->where('mid = ?', $this->request->mid)
                ->where('type = ?', self::$type)->limit(1));

            if (!$meta) {
                $this->response->redirect(Typecho_Common::url('manage-categories.php', $this->options->adminUrl));
            }

            $name->value($meta['name']);
            $slug->value($meta['slug']);
            //$parent->value($meta['parent']);
            $description->value($meta['description']);
            $do->value('update');
            $mid->value($meta['mid']);
            $submit->value(_t('编辑专题'));
            $_action = 'update';
        } else {
            $do->value('insert');
            $submit->value(_t('增加专题'));
            $_action = 'insert';
        }

        if (empty($action)) {
            $action = $_action;
        }

        /** 给表单增加规则 */
        if ('insert' == $action || 'update' == $action) {
            $name->addRule('required', _t('必须填写专题名称'));
            $name->addRule(array($this, 'nameExists'), _t('专题名称已经存在'));
            $name->addRule(array($this, 'nameToSlug'), _t('专题名称无法被转换为缩略名'));
            $name->addRule('xssCheck', _t('请不要在专题名称中使用特殊字符'));
            $slug->addRule(array($this, 'slugExists'), _t('缩略名已经存在'));
            $slug->addRule('xssCheck', _t('请不要在缩略名中使用特殊字符'));
        }

        if ('update' == $action) {
            $mid->addRule('required', _t('专题主键不存在'));
            $mid->addRule(array($this, 'seriesExists'), _t('专题不存在'));
        }

        return $form;
    }

    public function insertSeries() {
        if ($this->form('insert')->validate()) {
            $this->response->goBack();
        }

        /** 取出数据 */
        $meta_series = $this->request->from('name', 'slug', 'description', 'parent');

        $meta_series['slug'] = Typecho_Common::slugName(empty($meta_series['slug']) ? $meta_series['name'] : $meta_series['slug']);
        $meta_series['type'] = self::$type;
        $meta_series['parent'] = 0;
        $meta_series['order'] = $this->getMaxOrder(self::$type, $meta_series['parent']) + 1;
        /** 插入数据 */
        $meta_series['mid'] = $this->insert($meta_series);
        $this->push($meta_series);

        /** 设置高亮 */
        $this->widget('Widget_Notice')->highlight($this->theId);

        /** 提示信息 */
        $this->widget('Widget_Notice')->set(_t('专题 <a href="%s">%s</a> 已经被增加', $this->permalink, $this->name), 'success');

        /** 转向原页 */
        $this->response->redirect(Typecho_Common::url('extending.php?panel='.urlencode(trim("PostSeries/manage-series.php", '/')), $this->options->adminUrl));
    }

    /**
     * 更新分类
     *
     * @access public
     * @return void
     */
    public function updateSeries() {
        if ($this->form('update')->validate()) {
            $this->response->goBack();
        }

        /** 取出数据 */
        $meta_series = $this->request->from('name', 'slug', 'description', 'parent');
        $meta_series['mid'] = $this->request->mid;
        $meta_series['slug'] = Typecho_Common::slugName(empty($meta_series['slug']) ? $meta_series['name'] : $meta_series['slug']);
        $meta_series['type'] = self::$type;
        $current = $this->db->fetchRow($this->select()->where('mid = ?', $meta_series['mid']));

        if ($current['parent'] != $meta_series['parent']) {
            $parent = $this->db->fetchRow($this->select()->where('mid = ?', $meta_series['parent']));

            if ($parent['mid'] == $meta_series['mid']) {
                $meta_series['order'] = $parent['order'];
                $this->update(array(
                    'parent'    =>  $current['parent'],
                    'order'     =>  $current['order']
                ), $this->db->sql()->where('mid = ?', $parent['mid']));
            } else {
                $meta_series['order'] = $this->getMaxOrder(self::$type, $meta_series['parent']) + 1;
            }
        }

        /** 更新数据 */
        $this->update($meta_series, $this->db->sql()->where('mid = ?', $this->request->filter('int')->mid));
        $this->push($meta_series);
        /** 设置高亮 */
        $this->widget('Widget_Notice')->highlight($this->theId);

        /** 提示信息 */
        $this->widget('Widget_Notice')->set(_t('专题 <a href="%s">%s</a> 已经被更新',
            $this->permalink, $this->name), 'success');

        /** 转向原页 */
        $this->response->redirect(Typecho_Common::url('extending.php?panel='.urlencode(trim("PostSeries/manage-series.php", '/')), $this->options->adminUrl));
    }

    /**
     * 分类排序
     *
     * @access public
     * @return void
     */
    public function sortSeries()
    {
        $categories = $this->request->filter('int')->getArray('mid');
        if ($categories) {
            $this->sort($categories, self::$type);
        }

        if (!$this->request->isAjax()) {
            /** 转向原页 */
            $this->response->redirect(Typecho_Common::url('extending.php?panel='.urlencode(trim("PostSeries/manage-series.php", '/')), $this->options->adminUrl));
        } else {
            $this->response->throwJson(array('success' => 1, 'message' => _t('分类排序已经完成')));
        }
    }

    /**
     * 合并专题
     *
     * @access public
     * @return void
     */
    public function mergeSeries()
    {
        /** 验证数据 */
        $validator = new Typecho_Validate();
        $validator->addRule('merge', 'required', _t('分类主键不存在'));
        $validator->addRule('merge', array($this, 'seriesExists'), _t('请选择需要合并的分类'));

        if ($error = $validator->run($this->request->from('merge'))) {
            $this->widget('Widget_Notice')->set($error, 'error');
            $this->response->goBack();
        }

        $mid = $this->request->merge;
        $contents = $this->request->filter('int')->getArray('cid');

        if ($contents) {
            //$this->merge($merge, self::$type, $categories);
            $existsContents = Typecho_Common::arrayFlatten($this->db->fetchAll($this->db
                ->select('cid')->from('table.relationships')
                ->where('mid = ?', $mid)), 'cid');

            $diffContents = array_diff($contents, $existsContents);
            foreach ($diffContents as $content) {
                $this->db->query($this->db->insert('table.relationships')
                    ->rows(array('mid' => $mid, 'cid' => $content)));
                $contents[] = $content;
            }
            $num = $this->db->fetchObject($this->db
                ->select(array('COUNT(mid)' => 'num'))->from('table.relationships')
                ->where('table.relationships.mid = ?', $mid))->num;

            $this->update(array('count' => $num), $this->db->sql()->where('mid = ?', $mid));


            /** 提示信息 */
            $this->widget('Widget_Notice')->set(_t('分类已经合并'), 'success');
        } else {
            $this->widget('Widget_Notice')->set(_t('没有选择任何分类'), 'notice');
        }

        /** 转向原页 */
        $this->response->goBack();
    }

    public function midSeriesPosts($mid = null) {
        $mid = $mid == null ? $this->request->mid : $mid;
        if (null == $mid) {
            return array();
        }
        $select = Typecho_Widget::widget('Widget_Contents_Post_Admin')->select();
        $select->join('table.relationships', 'table.contents.cid = table.relationships.cid')
            ->where('table.relationships.mid = ?', $mid)->order('table.contents.created', Typecho_Db::SORT_ASC);
        $result = $this->db->fetchAll($select);
        return $result;
    }

    public function midSeries() {
        $mid = $this->request->mid;
        if (null == $mid) {
            return array();
        }
        $select = $this->db->select('*')->from('table.metas')->where('mid = ?', $mid);
        $result = $this->db->fetchAll($select);
        //var_dump($result);
        return $result;

    }

    public function removeSeriesCid($mid, $cid) {
        $this->db->query($this->db->delete('table.relationships')->where('mid = ? AND cid = ?', $mid, $cid));
        $num = $this->db->fetchObject($this->db
            ->select(array('COUNT(mid)' => 'num'))->from('table.relationships')
            ->where('table.relationships.mid = ?', $mid))->num;

        $this->update(array('count' => $num), $this->db->sql()->where('mid = ?', $mid));
        if (!$this->request->isAjax()) {
            /** 转向原页 */
            $this->response->goBack();
        } else {
            $this->response->throwJson(array('success' => 1, 'message' => _t('分类排序已经完成')));
        }
    }



}