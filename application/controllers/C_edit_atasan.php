<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_edit_atasan extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model('M_weblen');
    }
    
    public function index($id_emp){

        $data = array();
        $data['karyawan'] = $this->M_weblen2->getDataKar($id_emp); //get data karyawan        
        $data['evaluasi'] = $this->newDataEval($data['karyawan']['id_evaluasi']);
        $data['absensi'] = $this->newDataAbs($data['karyawan']['id_absensi']);
        $this->load->view('atasan/V_edit_atasan',$data);
    }

    public function convertEval ($point) // mengubah persen% evaluasi kedalam bentuk point2
    {
        if ($point == 6.7) {
            $x = '5 (Sangat Baik)' ;
        }
        elseif ($point == 5.3){
            $x = '4 (Baik)';
        }
        elseif ($point == 4.0){
            $x = '3 (Cukup)';
        }
        elseif ($point == 2.7){
            $x = '2 (Kurang)';
        }
        elseif ($point == 1.3){
            $x = '1 (Sangat Kurang)';
        }
        else{
            $x = 'none';
        }
        return $x;
    }

    public function newDataEval ($id)
    {
        $eval = array();
        $eval = $this->M_weblen2->getDataEval($id);
        $dataEval = [
            'id_evaluasi' => $eval['id_evaluasi'],
            'nik' => $eval['nik'],
            'date_fill' => $eval['date_fill'],
            'inisiatif' => $this->convertEval($eval['inisiatif']),
            'daya_kreatif' => $this->convertEval($eval['daya_kreatif']),
            'prob_solve' => $this->convertEval($eval['prob_solve']),
            'tang_jawab' => $this->convertEval($eval['tang_jawab']),
            'kom_per' => $this->convertEval($eval['kom_per']),
            'etika_kerja' => $this->convertEval($eval['etika_kerja']),
            'adap_kerja' => $this->convertEval($eval['adap_kerja']),
            'pelayanan' => $this->convertEval($eval['pelayanan']),
            'kem_tugas' => $this->convertEval($eval['kem_tugas']),
            'pen_diri' => $this->convertEval($eval['pen_diri']),
            'kem_komunikasi' => $this->convertEval($eval['kem_komunikasi']),
            'ker_sama' => $this->convertEval($eval['ker_sama']),
            'disiplin' => $this->convertEval($eval['disiplin']),
            'sis_kerja' => $this->convertEval($eval['sis_kerja']),
            'has_kerja' => $this->convertEval($eval['has_kerja']),
            'nilai_eval' => $eval['nilai_eval'],
            'nilai_kinerja' => $eval['nilai_kinerja'],
            'nama_atasan' => $eval['nama_atasan'],
            'nik_atasan' => $eval['nik_atasan']
        ];
        return $dataEval;
    }

    public function convPoint($point){
        if ($point == 5) {
            $x = 6.7;
        }
        elseif ($point == 4){
            $x = 5.3;
        }
        elseif ($point == 3){
            $x = 4.0;
        }
        elseif ($point == 2){
            $x = 2.7;
        }
        elseif ($point == 1){
            $x = 1.3;
        }
        return round($x, 2);
    }//end func

    public function ttlEval($kin)  //nilai 30 %
    {
        $x = ($kin*70)/100;
        return round($x, 0, PHP_ROUND_HALF_DOWN);
    }//end func

    public function finalResult($abs, $eval){
        return $abs + $eval;
    }
    
    public function convertAbs($point, $durasi) // mengubah persen% absensi kedalam bentuk point2
    {
        $x = ($point * $durasi) / 100 ;
        return round($x);
    }

    public function kesimpulan($stat, $jpagu, $putus, $lain)
    {
        if ($stat === "Diputus") {
            $dataStat = [
                'status' => $stat,
                'alasan' => $putus,
                'j_pagu' => '-'
            ];
        }
        elseif ($stat === "Lainnya") {
            $dataStat = [
                'status' => $lain,
                'alasan' => '-',
                'j_pagu' => $jpagu
            ];
        }
        elseif ($stat === "Diperpanjang 3 Bulan" || $stat === "Diperpanjang 1 Tahun" || $stat === "Diperpanjang 6 Bulan") {
            $dataStat = [
                'status' => $stat,
                'alasan' => '-',
                'j_pagu' => $jpagu
            ];
        } //end if
        
        return $dataStat;
        
    }
    
    public function newDataAbs($id)
    {
        $abs = array();
        $abs = $this->M_weblen2->getDataAbs($id);
        $dataAbs = [
            'id_absensi' => $abs['id_absensi'],
            'sakit' => $this->convertAbs($abs['sakit'],$abs['periode']),
            'izin'=> $this->convertAbs($abs['izin'],$abs['periode']),
            'alpa' => $this->convertAbs($abs['alpa']/2,$abs['periode']),
            'periode'=> $abs['periode'],
            'terlambat'=> $this->convertAbs($abs['terlambat'],$abs['periode']),
            'nilai_absen' => $abs['nilai_absen'],
            'nilai_produktivitas' => $abs['nilai_produktivitas']
        ];
        return $dataAbs;
    }

    public function addPenilaian($id_emp) //kasih parameter
    {

        $dataEmp = $this->M_weblen->getDataKar($id_emp); //get data karyawan

        $this->form_validation->set_rules('inisiatif', 'Inisiatif', 'required|trim');
        $this->form_validation->set_rules('kreatif', 'Kreatif', 'required|trim');
        $this->form_validation->set_rules('probsolv', 'Problem Solving', 'required|trim');
        $this->form_validation->set_rules('tjawab', 'Tanggung Jawab', 'required|trim');
        $this->form_validation->set_rules('komitmen', 'Komitmen', 'required|trim');
        $this->form_validation->set_rules('etika', 'Etika Kerja', 'required|trim');
        $this->form_validation->set_rules('adaptasi', 'Adaptasi Kerja', 'required|trim');
        $this->form_validation->set_rules('pelayanan', 'Pelayanan', 'required|trim');
        $this->form_validation->set_rules('ktugas', 'Kemampuan Tugas', 'required|trim');
        $this->form_validation->set_rules('penyesuaian', 'Penyesuaian Diri', 'required|trim');
        $this->form_validation->set_rules('komunikasi', 'Komunikasi', 'required|trim');
        $this->form_validation->set_rules('kerjasama', 'Kerja Sama', 'required|trim');
        $this->form_validation->set_rules('disiplin', 'Disiplin', 'required|trim');
        $this->form_validation->set_rules('skerja', 'Sistematika', 'required|trim');
        $this->form_validation->set_rules('hkerja', 'Hasil Pekerjaan', 'required|trim');

        $this->form_validation->set_rules('combo1','Status','required');
        $x = $this->input->post('combo1');
        if ($x === "Diputus") {
            $this->form_validation->set_rules('combo_putus', 'Alasan putus', 'required|trim');
        }
        elseif ($x === "Lainnya") {
            $this->form_validation->set_rules('inp_lainnya', 'Lainnya', 'required|trim');
            $this->form_validation->set_rules('combo_pagu', 'Jenis pagu', 'required|trim');
        } //end if
        elseif ($x === "Diperpanjang 3 Bulan" || $x === "Diperpanjang 1 Tahun" || $x === "Diperpanjang 6 Bulan") {
            $this->form_validation->set_rules('combo_pagu', 'Jenis pagu', 'required|trim');
        } //end if
        

        if($this->form_validation->run() == false){

            // $this->load->view('atasan/V_nilai_atasan', $dataEmp);
            $data = array();
            $data['karyawan'] = $this->M_weblen2->getDataKar($id_emp); //get data karyawan
            $data['absensi'] = $this->newDataAbs($data['karyawan']['id_absensi']);
            $this->load->view('atasan/V_nilai_atasan',$data);
        
        } //end if

        else{

            $dataAbs = $this->M_weblen->getDataAbs($dataEmp['id_absensi']); //get data absensi
            
            $aa = $this->input->post('inisiatif');
            $bb = $this->input->post('kreatif');
            $cc = $this->input->post('probsolv');
            $dd = $this->input->post('tjawab');
            $ee = $this->input->post('komitmen');
            $ff = $this->input->post('etika');
            $gg = $this->input->post('adaptasi');
            $hh = $this->input->post('pelayanan');
            $ii = $this->input->post('ktugas');
            $jj = $this->input->post('penyesuaian');
            $kk = $this->input->post('komunikasi');
            $ll = $this->input->post('kerjasama');
            $mm = $this->input->post('disiplin');
            $nn = $this->input->post('skerja');
            $oo = $this->input->post('hkerja');


            $kinerja = $this->convPoint($aa)+$this->convPoint($bb)+$this->convPoint($cc)+$this->convPoint($dd)+
            $this->convPoint($ee)+$this->convPoint($ff)+$this->convPoint($gg)+$this->convPoint($hh)+$this->convPoint($ii)+
            $this->convPoint($jj)+$this->convPoint($kk)+$this->convPoint($ll)+
            $this->convPoint($mm)+$this->convPoint($nn)+$this->convPoint($oo) ;
            $evl = $this->ttlEval($kinerja);
            $now = date("Y-m-d");
            $dataEvl = [
                'nik' => $dataEmp['nik'],
                'date_fill' => $now,
                'inisiatif' => $this->convPoint($aa),
                'daya_kreatif' => $this->convPoint($bb),
                'prob_solve' => $this->convPoint($cc),
                'tang_jawab' => $this->convPoint($dd),
                'kom_per' => $this->convPoint($ee),
                'etika_kerja' => $this->convPoint($ff),
                'adap_kerja' => $this->convPoint($gg),
                'pelayanan' => $this->convPoint($hh),
                'kem_tugas' => $this->convPoint($ii),
                'pen_diri' => $this->convPoint($jj),
                'kem_komunikasi' => $this->convPoint($kk),
                'ker_sama' => $this->convPoint($ll),
                'disiplin' => $this->convPoint($mm),
                'sis_kerja' => $this->convPoint($nn),
                'has_kerja' => $this->convPoint($oo),
                'nilai_eval' => $evl,
                'nilai_kinerja' => round($kinerja, 0, PHP_ROUND_HALF_DOWN)
            ];

            $res = $this->finalResult($dataAbs['nilai_absen'], $dataEvl['nilai_eval']); //total nilai penilaian keseluruhan
            $this->M_weblen->updateEvl($dataEvl); //save to table evaluasi
            
            $idEvl = $this->M_weblen->getIdEval($dataEvl['nik'])['id_evaluasi']; //perlu perbaikan
            $this->M_weblen->updateKar($dataEvl['nik'],$idEvl,$res);
            
            $stat = $this->input->post('combo1');
            $jpagu = $this->input->post('combo_pagu');
            $putus = $this->input->post('combo_putus');
            $lain = $this->input->post('inp_lainnya');

            $dataStat = $this->kesimpulan($stat, $jpagu, $putus, $lain);
            
            $this->M_weblen->updateStat($id_emp, $dataStat);

            $this->session->set_flashdata('evalAt', '<div class="alert alert-success" role="alert">
            Data saved!</div>');
            redirect('C_history_atasan'); 

            
        }// end else
    }
    

}