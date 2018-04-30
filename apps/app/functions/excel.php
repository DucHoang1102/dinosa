<?php
namespace App\functions;

use PHPExcel;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_IOFactory;
use PHPExcel_Style_Fill;

class Excel
{
	private $PHPExcel = null;

	function __construct()
	{
		include_once 'PHPExcel/PHPExcel.php';
		$this->PHPExcel = new PHPExcel();

		$this->create()->setWidthHeightDefault()->setStyle();
	}

	public function create()
	{
		$this->PHPExcel->setActiveSheetIndex(0)
		 ->setTitle('Đơn-hàng');

		// Tiêu đề - PHP_EOL là kí tự xuống dòng
		$this->PHPExcel->getActiveSheet()
					   ->setCellValue('A1', 'Số thứ tự')
					   ->setCellValue('B1', 'Số hiệu')
					   ->setCellValue('C1', 'TÊN NGƯỜI NHẬN')
					   ->setCellValue('D1', 'ĐỊA CHỈ NGƯỜI NHẬN')
					   ->setCellValue('E1', 'SỐ ĐIỆN THOẠI')
					   ->setCellValue('F1', 'SỐ TIỀN COD')
					   ->setCellValue('G1', 'NỘI DUNG HÀNG')
					   ->setCellValue('H1', 'GHI CHÚ');
		return $this;
	}

	public function setWidthHeightDefault()
	{
		// Set Width for header
		$this->PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(29);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(24);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
		$this->PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(34);

		// Set Height for header
		$this->PHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

		return $this;
	}

	public function setStyle()
	{
		// Format cell: fromt a1 to h1 - Định dạng cho tiêu đề
		$header = 'a1:h1';

		// Thiết lập border cho tiêu đề
		$this->PHPExcel->getActiveSheet()->getStyle($header)->getBorders()
															->getAllBorders()
															->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		// Căn giữa text trong tiêu đề
		$this->PHPExcel->getActiveSheet()->getStyle($header)->getAlignment()
															->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
															->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
															->setWrapText(true);

		// Thiết lập định dạng cho tiêu đề
		$this->PHPExcel->getActiveSheet()->getStyle($header)->getFont()
															->setBold(true)
															->setName('Arial')
															->setSize(12)
															->getColor()->setRGB('000000');

		// Thiết lập background color cho header 
		$this->PHPExcel->getActiveSheet()->getStyle($header)
										 ->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
										 ->getStartColor()
										 ->setRGB('FFFF00');

		return $this;
	}

	public function setDatas($datas)
	{
		$i = 2;
		foreach ($datas as $key => $order) {
			$this->PHPExcel->getActiveSheet()
					       ->setCellValue('A'.$i, $key+1) // STT
					       ->setCellValue('B'.$i, '') // Số hiệu đơn hàng
					       ->setCellValue('C'.$i, $order->name) // Tên người nhận
					       ->setCellValue('D'.$i, $order->address) // Điện chỉ người nhận
					       ->setCellValue('E'.$i, $order->phone) // Điện thoại người nhận
					       ->setCellValue('F'.$i, str_replace(",", "", $order->total_money)) // Số tiền(COD)
					       ->setCellValue('G'.$i, 'Áo thun') // Nội dung hàng
					       ->setCellValue('H'.$i, 'Không thu phí của khách'); // Ghi chú 

			// Thiết lập chiều cao dòng của mỗi order
			$this->PHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(25);

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