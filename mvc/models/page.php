<?php


class Page extends Model
{

	public function getList($only_published = false)
	{
		$sql = "select * from pages where 1";

		if( $only_published )
		{
			$sql .= " and is_published = 1";
		}

		return $this->db->query($sql);
	}

	public function getByAlias($alias)
	{
		$alias = $this->db->escape($alias);
		$sql = "select * from pages where alias = '{$alias}' limit 1 ";
		$result =  $this->db->query($sql);
		return isset($result[0]) ? $result[0] : null;

	}

	public function getById($id)
	{
		$id = (int)$id;
		$sql = "select * from pages where id = '{$id}' limit 1 ";
		$result =  $this->db->query($sql);
		return isset($result[0]) ? $result[0] : null;

	}

	public function save($data, $id = null)
	{
		if( !isset($data['alias']) || !isset($data['title']) || !isset($data['content']) )
		{
			return false;
		}

		$id = (int)$id;
		$alias = $this->db->escape($data['alias']);
		$title = $this->db->escape($data['title']);
		$content = $this->db->escape($data['content']);
		$is_published = isset($data['is_published']) ? 1 : 0;

		if( !$id ) // add new record
		{
			$sql = " 
			insert into pages 
				set alias = '{$alias}',
					title = '{$title}',
					content = '{$content}',
					is_published = '{$is_published}'
			 ";
		}
		else //update existing record
		{
			$sql = " 
			update pages 
				set alias = '{$alias}',
					title = '{$title}',
					content = '{$content}',
					is_published = '{$is_published}'
				where id = {$id} 
			 ";
		}

		return $this->db->query($sql);
	}

	public function delete($id)
	{
		$id = (int)$id;

		$sql = "delete from pages where id={$id}";
		return $this->db->query($sql);
	}
}