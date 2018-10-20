<?php
class PostData {
	public static $tablename = "post";


	public function PostData(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (title,content,category_id,image,user_id,created_at) ";
		$sql .= "value (\"$this->title\",\"$this->content\",$this->category_id,\"$this->image\",$this->user_id, NOW())";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto PostData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",content=\"$this->content\",image=\"$this->image\",category_id=\"$this->category_id\",status=$this->status where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());

	}

	public static function getAllByUser($id){
		$sql = "select * from ".self::$tablename." where user_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());

	}
	
		public static function getAllActive(){
		$sql = "select * from ".self::$tablename." where status=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());

	}

			public static function getAllByCat($id){
		$sql = "select * from ".self::$tablename." where category_id=$id and status=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());

	}
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}


}

?>