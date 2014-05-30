<?php namespace Fashion\Services\Mailers;



class ContactMailer extends Mailer
{
	
	public function contact($user)
	{
		$view = 'emails.contact';
		
		$data = $user;
		$subject = 'Información desde formulario de contacto de Fashion Factory';

		return $this->sendTo($user, $subject, $view, $data);
	}
}

