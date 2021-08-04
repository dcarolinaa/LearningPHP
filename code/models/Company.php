<?php
namespace App\models;

class Company extends Model implements IModel{

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    protected $id;
    private $user_admin;
    private $name;
    private $slug;
    private $status;
    private $create_date;
    private $update_user;    

    public static function getTable() {
        return 'companies';
    }

    public static function getAttributes() {
        return [
            'id',
            'user_admin',
            'name',
            'slug',
            'status',
            'create_date',            
            'update_date',
            'update_user'
        ];
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUser_admin($idUserAdmin) {
        $this->user_admin = $idUserAdmin;
    }

    public function getUser_admin() {
        return $this->user_admin;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setSlug($slug){
        $this->slug = $slug;
    }

    public function getSlug(){
        return $this->slug;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setCreate_date($create_date) {
        $this->create_date = $create_date;
        return $this;
    }

    public function getCreate_date() {
        return $this->create_date;
    }

    public function setUpdate_date($updateAt) {
        $this->update_date = $updateAt;
        return $this;
    }

    public function getUpdate_date() {
        return $this->update_date;
    }

    public function setUpdate_user($idUser) {
        $this->update_user = $idUser;
        return $this;
    }

    public function getUpdate_user() {
        return $this->update_user;
    }
}