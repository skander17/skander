<?php


namespace App\Services;


use Core\Views\View;
use Dompdf\Dompdf;
use Dompdf\Options;

class Report
{
    private static $data = [];
    private static $index = [];
    private static $title;
    private static $username;
    private static $date;
    private static $orientation = "portrait";
    public static $report;
    public static $current_url;


    /**
     * @return Report
     */
    public static function report(){
        self::$report = new self();
        return self::$report;
    }

    public function render($html)
    {
        $html = self::getHtml($html);
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true);
        $pdf = new DOMPDF($options);

        $pdf->setPaper("Letter", self::$orientation);
        $pdf->loadHtml($html);
        $pdf->render();

        $canvas = $pdf->getCanvas();
        $footer = $canvas->open_object();

        $w = $canvas->get_width();

        $h = $canvas->get_height();

        $canvas->page_text($w - 60, $h - 28, "Página {PAGE_NUM} de {PAGE_COUNT}", $pdf->getFontMetrics()->getFont("helvetica", "bold"), 6);
        $canvas->page_text($w - 590, $h - 28, "", $pdf->getFontMetrics()->getFont("helvetica", "bold"), 6);

        $canvas->close_object();
        $canvas->add_object($footer, "all");
        $pdf->stream('report.pdf', array('Attachment' => 0));
        return $pdf;
    }

    /**
     * @param $html
     * @return false|string
     */
    public function getHtml($html = 'automatic')
    {
        $data = [];
        $data['index'] = self::$index;
        $data['data'] = self::$data;
        $data['title'] = self::$title;
        $data['username'] = self::$username;
        $data['date'] = self::$date;
        return View::render("reports/${html}",$data);
    }


    /**
     * @param array $data
     * @return Report
     */
    public function setData(array $data)
    {
        self::$data = $data;
        return self::$report;
    }

    /**
     * @param array $index
     * @return Report
     */
    public function setIndex(array $index)
    {
        self::$index = $index;
        return self::$report;

    }

    /**
     * @param mixed $title
     * @return Report
     */
    public function setTitle($title)
    {
        self::$title = $title;
        return self::$report;

    }

    /**
     * @param mixed $username
     * @return Report
     */
    public function setUsername($username)
    {
        self::$username = $username;
        return self::$report;

    }

    /**
     * @param mixed $current_url
     * @return Report
     */
    public function setCurrentUrl($current_url)
    {
        self::$current_url = $current_url;
        return self::$report;

    }

    /**
     * @param mixed $date
     * @return Report
     */
    public function setDate($date)
    {
        self::$date = $date;
        return self::$report;

    }

    /**
     * @param string $orientation
     * @return Report
     */
    public function setOrientation(string $orientation)
    {
        self::$orientation = $orientation;
        return self::$report;

    }

    /**
     * @param mixed $report
     * @return Report
     */
    public function setReport($report)
    {
        self::$report = $report;
        return self::$report;

    }
}