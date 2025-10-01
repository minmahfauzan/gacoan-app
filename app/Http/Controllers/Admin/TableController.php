<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TableModel;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TableController extends Controller
{
    public function qrcodes()
    {
        $tables = TableModel::all();
        $qrCodes = [];

        foreach ($tables as $table) {
            $qrCodes[$table->id] = $this->generateQrCode(
                route('table.login.qr', ['table_number' => $table->id])
            );
        }

        return view('admin.tables.qrcodes', compact('tables', 'qrCodes'));
    }

    private function generateQrCode(string $url): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle(150, 2), // 150px, margin 2
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrCodeImage = base64_encode($writer->writeString($url));

        return 'data:image/svg+xml;base64,' . $qrCodeImage;
    }
}
