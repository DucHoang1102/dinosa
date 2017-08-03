<?php
namespace App\functions;

use PHPMailer;

class Email
{
	protected $mail = null;

	function __construct()
	{
		include_once 'mailer/class.smtp.php';
		include_once 'mailer/class.phpmailer.php';

		$this->mail = new PHPMailer();
		$this->setDefault()->setInfoFrom()->setInfoTo();
	}

	protected function setDefault() 
	{
		$this->mail->isSMTP();
		$this->mail->CharSet    = "utf-8";
		$this->mail->SMTPDebug  = 0; // Tắt báo lỗi
		$this->mail->SMTPAuth   = true;
		$this->mail->SMTPSecure = "ssl";
		$this->mail->Host       = "smtp.gmail.com";
		$this->mail->Port       = 465;

		return $this;
	}

	public function setInfoFrom($mFrom="", $mPass="", $nFrom="", $mReply="", $nReply="")
	{
		// setDefault
		if ($mFrom  == "") $mFrom  = "ndhdldt3@gmail.com";
		if ($mPass  == "") $mPass  = "mduchoangaicaotrang9399l";
		if ($nFrom  == "") $nFrom  = "Nguyễn Đức Hoàng";
		if ($mReply == "") $mReply = $mFrom;
		if ($nReply == "") $nReply = $nFrom;
		/*-----------------------------------*/

		$this->mail->Username = $mFrom;
		$this->mail->Password = $mPass;
		$this->mail->SetFrom($mFrom, $nFrom);
		$this->mail->AddReplyTo($mReply, $nReply);

		return $this;
	}

	public function setInfoTo($mTo="", $nTo="")
	{
		// setDefault
		if ($mTo == "") $mTo = "ndhdldt1@gmail.com"; //bcnguyencothach.bdhn@gmail.com
		if ($nTo == "") $nTo = "Bưu cục VNPOST";
		/*-----------------------------------*/

		$this->mail->AddAddress($mTo, $nTo);

		return $this;
	}

	public function sendMail($title="", $body="", $file_name="", $file_title="")
	{
		$this->mail->Subject = $title;
		$this->mail->MsgHTML($body);
		$this->mail->AddAttachment($file_name, $file_title);
		//echo $this->mail->ErrorInfo;
		return $this->mail->Send();
	}
}