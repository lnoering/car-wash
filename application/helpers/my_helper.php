<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('date_to_human'))
{
	function date_to_human($time = '')
	{
		if($time != '') 
		{
			//YYYY-MM-DD TO DD/MM/AAAA
			return substr($time, 8, 2)."/".substr($time, 5, 2)."/".substr($time, 0, 4);
		}
	}
}

if ( ! function_exists('datetime_to_human'))
{
	function datetime_to_human($time = '')
	{
		if($time != '') 
		{
			//YYYY-MM-DD HH:MM:SS TO DD/MM/AAAA HH:MM:SS
			return substr($time, 8, 2)."/".substr($time, 5, 2)."/".substr($time, 0, 4).substr($time, 10, 8);
		}
	}
}

if ( ! function_exists('time_to_mysql'))
{
	function time_to_mysql($time = '')
	{
		if($time != '') 
		{
			if (preg_match('/^\d{2}\:\d{2}\:\d{2}$/', $time))
			{
				return $time;
			} else {
				//HH:MM TO HH:MM:SS
				return $time.':00';
			}
		}
	}
}

if ( ! function_exists('date_to_mysql'))
{
	function date_to_mysql($time = '')
	{
		if($time != '') 
		{
			if (preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $time))
			{
				return $time;
			} else {
				// DD/MM/AAAA TO YYYY-MM-DD

				$time = str_replace('/', '', $time);
				// DDMMAAAA 

				return substr($time, 4, 4)."-".substr($time, 2, 2)."-".substr($time, 0, 2);
			}
		}
	}
}

if ( ! function_exists('datetime_to_mysql'))
{
	function datetime_to_mysql($date = '', $time = '')
	{
		if($time != '' && $date != '') 
		{
			//YYYY-MM-DD HH:MM:SS TO DD/MM/AAAA HH:MM:SS
			return date_to_mysql($date).' '.time_to_mysql($time);
		}
	}
}

if ( ! function_exists('remove_time'))
{
	function remove_time($time = '')
	{
		if($time != '') 
		{
			return explode(' ',$time)[0];
		}
	}
}

?>