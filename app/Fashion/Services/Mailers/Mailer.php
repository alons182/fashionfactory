<?php namespace Fashion\Services\Mailers;

use Mail;

abstract class Mailer 
{

	public function sendTo($emailTo, $subject, $view, $data = [])
	{
		
		Mail::send($view, $data, function ($message) use($emailTo, $subject)
		{
			
			$message->to($emailTo)
					->subject($subject);

		});



	}
}

