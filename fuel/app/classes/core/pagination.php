<?php

class Pagination extends \Fuel\Core\Pagination 
{

	/**
	 * startを修正
	 * @see http://btt.hatenablog.com/entry/2012/06/20/001202
	 *
	 * @return	string	Markup for the pagination block
	 */
	public function pages_render()
	{
		// no links if we only have one page
		if ($this->config['total_pages'] == 1)
		{
			return '';
		}

		$html = '';

		// let's get the starting page number, this is determined using num_links
		$start = (($this->config['calculated_page'] - $this->config['num_links']) > 0) ? $this->config['calculated_page'] - ($this->config['num_links'] - 0) : 1;

		// let's get the ending page number
		$end = (($this->config['calculated_page'] + $this->config['num_links']) < $this->config['total_pages']) ? $this->config['calculated_page'] + $this->config['num_links'] : $this->config['total_pages'];

		for($i = $start; $i <= $end; $i++)
		{
			if ($this->config['calculated_page'] == $i)
			{
				$html .= str_replace(
				    '{link}',
				    str_replace(array('{uri}', '{page}'), array('#', $i), $this->template['active-link']),
				    $this->template['active']
				);
				$this->raw_results[] = array('uri' => '#', 'title' => $i, 'type' => 'active');
			}
			else
			{
				$html .= str_replace(
				    '{link}',
				    str_replace(array('{uri}', '{page}'), array($this->_make_link($i), $i), $this->template['regular-link']),
				    $this->template['regular']
				);
				$this->raw_results[] = array('uri' => $this->_make_link($i), 'title' => $i, 'type' => 'regular');
			}
		}

		return $html;
	}
}
