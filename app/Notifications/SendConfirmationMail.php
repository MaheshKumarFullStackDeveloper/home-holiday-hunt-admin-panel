<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendConfirmationMail extends Notification {
	
	use Queueable;
	protected $mailSubject, $text , $userName;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	*/
	public function __construct($mailSubject, $text,$userName) {
		$this->mailSubject = $mailSubject;
		$this->text = $text;
		$this->userName = $userName;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	*/
	public function via($notifiable) {
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	*/
	public function toMail($notifiable) {
		return (new MailMessage)
			->subject($this->mailSubject)
			->from(env('MAIL_USERNAME','superadmin@holidayhomehunt.com'),env('MAIL_FROM_NAME','Holiday-Home-Hunt'))
			->markdown('emails.send_confirmation_mail', [
				'text' => $this->text, 'userName' => $this->userName,
			]);
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	*/
	public function toArray($notifiable)
	{
		return [
			//
		];
	}
}
