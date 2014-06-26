<?php namespace Fashion\Services\Mailers;



class ContactMailer extends Mailer
{
    protected $listLocalEmail = ['alonso@avotz.com'];
    protected $listProductionEmail = ['alons182@gmail.com'];

	public function contact($user)
	{
		$view = 'emails.contact';
		$data = $user;
		$subject = 'Información desde formulario de contacto de Fashion Factory';
        $emailTo = $this->listLocalEmail;
		return $this->sendTo($emailTo, $subject, $view, $data);
	}
}

