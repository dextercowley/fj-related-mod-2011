<?php
/**
 * @package		Joomla.Framework
 * @subpackage	Parameter
 * @copyright	Copyright (C) 2008 - 2012 Mark Dexter. Portions Copyright Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a SQL element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldFJSQL extends JFormFieldList
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	public $type = 'FJSQL';

	protected function getOptions()
	{
		$options = array();
		$key = $this->element('key_field') ? (string) $this->element('key_field') : 'value';
		$value	= $this->element['value_field'] ? (string) $this->element['value_field'] : (string) $this->element['name'];
		$query	= (string) $this->element['query'];

		// Get the database object.
		$db = JFactory::getDBO();

		// Set the query and get the result list.
		$db->setQuery($query);
		$items = $db->loadObjectlist();

			// Check for an error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
			return $options;
		}

		if ($node->attributes('multiple')) {
			$size = $node->attributes('size') ? $node->attributes('size') : '5';
			$multiple = ' multiple="multiple" size="'.$size.'"';
			$multipleArray = "[]";
		} else {
			$multiple = '';
			$multipleArray = '';
		}
		$attributes = 'class="inputbox" ' . $multiple;


		return JHTML::_('select.genericlist',  $items, ''.$control_name.'['.$name.']'.$multipleArray, $attributes, $key, $val, $value, $control_name.$name);
	}
}
