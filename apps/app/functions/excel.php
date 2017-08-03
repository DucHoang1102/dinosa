<?php
namespace App\functions;

use PHPExcel;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_IOFactory;

class Excel
{
	private $PHPExcel = null;

	function __construct()
	{
		include_once 'PHPExcel/PHPExcel.php';
		$this->PHPExcel = new PHPExcel();

		$this->create()->setWidth()->setStyle();
	}

	public function create()
	{
		$this->PHPExcel->setActiveSheetIndex(0)
		 ->setTitle('Đơn-hàng');

		// Tiêu đề - PHP_EOL là kí tự xuống dòng
		$this->PHPExcel->getActiveSheet()
					   ->setCellValue('A1', 'STT')
					   ->setCellValue('B1', 'Tên'.PHP_EOL.'Người'.PHP_EOL.'Gửi')
					   ->setCellValue('C1', 'Điện'.PHP_EOL.'Thoại'.PHP_EOL.'Người'.PHP_EOL.'Gửi')
					   ->setCellValue('D1', 'Địa Chỉ'.PHP_EOL.'Người Gửi')
					   ->setCellValue('E1', 'Số hiệu'.PHP_EOL.'Đơn'.PHP_EOL.'hàng')
					   ->setCellValue('F1', 'Mã'.PHP_EOL.'Số')
					   ->setCellValue('G1', 'Nội Dung'.PHP_EOL.'Hàng')
					   ->setCellValue('H1', 'Tên'.PHP_EOL.'Người'.PHP_EOL.'Nhận')
					   ->setCellValue('I1', 'Điện Thoại'.PHP_EOL.'Người Nhận')
					   ->setCellValue('J1', 'Địa Chỉ'.PHP_EOL.'Người'.PHP_EOL.'Nhận')
					   ->setCellValue('K1', 'Tỉnh'.PHP_EOL.'Phát')
					   ->setCellValue('L1', 'Số Tiền'.PHP_EOL.'COD (VNĐ)')
					   ->setCellValue('M1', 'Loại Hình'.PHP_EOL.'Vận Chuyển')
					   ->setCellValue('N1', 'MÃ BILL');
		return $this;
	}

	public function setWidth()
	{
		// Cell width
		$this->PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(5);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12);

		return $this;
	}

	public function setStyle()
	{
		// Format cell: fromt a1 to n1
		$header = 'a1:n1';

		// Thiết lập border cho tiêu đề
		$this->PHPExcel->getActiveSheet()->getStyle($header)->getBorders()
															->getAllBorders()
															->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		// Căn giữa text trong tiêu đề
		$this->PHPExcel->getActiveSheet()->getStyle($header)->getAlignment()
															->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER)
															->setWrapText(true);

		// Thiết lập định dạng cho tiêu đề
		$this->PHPExcel->getActiveSheet()->getStyle($header)->getFont()
															->setBold(true)
															->setName('Arial')
															->setSize(12)
															->getColor()->setRGB('000000');
		return $this;
	}

	public function setDatas($datas)
	{
		$i = 2;
		foreach ($datas as $key => $order) {
			$this->PHPExcel->getActiveSheet()
					       ->setCellValue('A'.$i, $key+1) // STT
					       ->setCellValue('B'.$i, 'Nguyễn Đức Hoàng') // Tên người gửi
					       ->setCellValue('C'.$i, '0972982082') // Điện thoai người gửi
					       ->setCellValue('D'.$i, 'Láng, Hà Nội') // Địa chỉ người gửi
					       ->setCellValue('E'.$i, '') // Số hiệu đơn hàng
					       ->setCellValue('F'.$i, '') // Mã số
					       ->setCellValue('G'.$i, 'Áo') // Nội Dung Hàng
					       ->setCellValue('H'.$i, $order->name) // Tên người nhận
					       ->setCellValue('I'.$i, $order->phone) // Điện thoại người nhận
					       ->setCellValue('J'.$i, $order->address) // Điện chỉ người nhận
					       ->setCellValue('K'.$i, '') // Tỉnh Phát
					       ->setCellValue('L'.$i, $order->total_money . ' vnđ') // Số tiền(COD)
					       ->setCellValue('M'.$i, '') // Loại hình vận chuyển
					       ->setCellValue('N'.$i, ''); // Mã bill 
			$i++;
		}

		return $this;
	}

	public function saveFile($path="", $file_name="")
	{
		// Ghi dữ liệu vào file, định dạng file excel 2007;
		$objWriter = PHPExcel_IOFactory::createWriter($this->PHPExcel, 'Excel2007');

		$full_path = $path . $file_name;

		$objWriter->save($full_path);
	}
}