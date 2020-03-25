<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('TemplateAdmin', NULL, 'template');
		$this->load->model('RATModel', 'mmain');
		$this->load->library('Pdf');
	}

	public function index()
	{
		$data['title']             = 'Rekap RAT';
		$data['content']           = 'rekap/index';
		$data['vitamin']           = 'rekap/vitamin';
		$data['arr']               = $this->mmain->rat_data();
		$data['rat_mulai_obj']     = new DateTime();
		$data['rat_akhir_obj']     = new DateTime();

		$this->template->template($data);
	}

	public function pdf($id_rat)
	{
		$mulai_obj = new DateTime();
		$akhir_obj = new DateTime();
		$arr       = $this->mmain->data_rat_rekap($id_rat);

		$kode_rat            = $arr->row()->kode_rat;
		$th_buku             = $arr->row()->th_buku;
		$periode_mulai       = $mulai_obj->createFromFormat('Y-m-d', $arr->row()->rat_mulai)->format('d-m-Y');
		$periode_akhir       = $akhir_obj->createFromFormat('Y-m-d', $arr->row()->rat_akhir)->format('d-m-Y');
		$ketua_sidang        = $arr->row()->ketua_sidang;
		$berita_acara        = $arr->row()->berita_acara;
		$prev_ketua_pengurus = $arr->row()->prev_ketua_pengurus;
		$prev_sekertaris     = $arr->row()->prev_sekertaris;
		$prev_bendahara      = $arr->row()->prev_bendahara;
		$new_ketua_pengurus  = $arr->row()->new_ketua_pengurus;
		$new_sekertaris      = $arr->row()->new_sekertaris;
		$new_bendahara       = $arr->row()->new_bendahara;

		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();

		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(0,10,"RAT - ".$kode_rat."", 0, 1, 'L', FALSE, NULL);

		$pdf->SetFont('Arial','',14);
		$pdf->Cell(0,5,"Tahun Buku ".$th_buku."", 0, 1, 'L', FALSE, NULL);

		$pdf->Ln();

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0,5,"Berita Acara", 0, 1, 'L', FALSE, NULL);

		$pdf->SetFont('Arial','',12);
		$pdf->MultiCell(0,5,$pdf->WriteHTML($berita_acara), 0, 'L', FALSE);

		$pdf->Ln();

		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(100, 5,"Pengurus", 1, 1, 'C', FALSE, NULL);

		// Ketua Pengurus
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(100, 5, "Ketua Pengurus", 1, 1, 'C');

		$pdf->Cell(50, 5, "Sebelum", 1, 0, 'C');
		$pdf->Cell(50, 5, "Sesudah", 1, 1, 'C');

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(50, 5, $prev_ketua_pengurus, 1, 0, 'C');
		$pdf->Cell(50, 5, $new_ketua_pengurus, 1, 1, 'C');
		// end Ketua Pengurus
		
		// Sekertaris
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(100, 5, "Sekertaris", 1, 1, 'C');

		$pdf->Cell(50, 5, "Sebelum", 1, 0, 'C');
		$pdf->Cell(50, 5, "Sesudah", 1, 1, 'C');

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(50, 5, $prev_sekertaris, 1, 0, 'C');
		$pdf->Cell(50, 5, $new_sekertaris, 1, 1, 'C');
		// end Sekertaris
		
		// Bendahara
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(100, 5, "Bendahara", 1, 1, 'C');

		$pdf->Cell(50, 5, "Sebelum", 1, 0, 'C');
		$pdf->Cell(50, 5, "Sesudah", 1, 1, 'C');

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(50, 5, $prev_bendahara, 1, 0, 'C');
		$pdf->Cell(50, 5, $new_bendahara, 1, 1, 'C');
		// end Bendahara

		$pdf->Output();
	}

}

/* End of file RekapController.php */
/* Location: ./application/controllers/admin/RekapController.php */