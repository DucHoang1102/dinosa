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
		if ($mPass  == "") $mPass  = "passmailpostdinosa";
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

	public function setInfoTo()
	{
		// Thiết lập người nhận mail post
		$mTo_1 = "ndhdldt1@gmail.com";
		$mTo_2 = "haibatrungbdtt1@gmail.com";
		$mTo_3 = "buudienhaibatrung@gmail.com";

		$nTo_self = "Bản sao VNPOST";
		$nTo_vnpost = "Bưu cục VNPOST";
		/*-----------------------------------*/

		$this->mail->AddAddress($mTo_1, $nTo_self);
		$this->mail->AddAddress($mTo_2, $nTo_vnpost);
		$this->mail->AddAddress($mTo_3, $nTo_vnpost);

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