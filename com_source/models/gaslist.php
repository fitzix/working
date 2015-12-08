<?php
defined('_JEXEC') or die;

class SourceModelGasList extends JModelList{

	public function __construct(array $config)
	{
		if(empty($config['filter_fields'])){
			$config['filter_fields'] = array(
				'id',
				'name',
				'standard',
				'brand'
			);

		}
		parent::__construct($config);
	}

	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('*')
			->from($db->quoteName('action_gasmanagement'));

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('name LIKE ' . $like);
		}


		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'id');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;
	}

}
