<?php

class Category extends Model {
    protected static $table = 'categories';

    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['parent_id'] = [
            'type' => 'int',
        ];
    }
    
    public static function getCategoryList()
    {
        return db::getInstance()->Select(
            'SELECT id_category, name FROM categories WHERE status=:status order by id_category',
            ['status' => Status::Active]
        );
    }

    public static function getCategories($parentId = 0)
    {
        return db::getInstance()->Select(
            'SELECT id_category, name FROM categories WHERE status=:status AND parent_id = :parent_id',
            ['status' => Status::Active, 'parent_id' => $parentId]
        );
    }
    
    public static function getCategoryInfo($id)
    {
        return db::getInstance()->Select(
            'SELECT name FROM categories WHERE id_category = :id_category',
            [':id_category' => $id]
        );
    }
}