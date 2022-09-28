<?php

namespace App\Repositories;

class BaseRepository
{
	protected $data = [];

	protected $name = 'Item';

	function __construct()
	{
		if (file_exists(static::PATH)) {
			$this->data = file_get_contents(static::PATH);
			$this->data = json_decode($this->data, TRUE);
		}
	}

	function __destruct()
	{
		file_put_contents(static::PATH, json_encode($this->data, JSON_PRETTY_PRINT));
	}

	public function all() : array
	{
		return $this->data;
	}

	public function find(string $id) : array
	{
		return $this->findBy('id', $id);
	}

	public function store(array $data) : void
	{
		$this->data[$data['id']] = $data;
	}

	public function delete(string $id = NULL) : void
	{
		$this->deleteBy('id', $id);
	}

	public function existBy(string $column, string $value) : bool
	{
		$data = array_column($this->data, $column);

		return in_array($value, $data);
	}

	public function findBy(string $column, string $value) : array
	{
		foreach ($this->data as $item) {
			if (array_key_exists($column, $item) && $item[$column] == $value) {
				return $item;
			}
		}
	}

	public function deleteBy(string $column, string $value) : void
	{
		foreach ($this->data as $id => $item) {
			if (array_key_exists($column, $item) && $item[$column] == $value) {
				unset($this->data[$id]);
				break;
			}
		}
	}

	public function update(array $data)
	{
		if (array_key_exists('id', $data) && array_key_exists($data['id'], $this->data)) {
			$this->data[$data['id']] = $data;

			return TRUE;
		}

		return FALSE;
	}
}