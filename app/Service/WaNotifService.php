<?php

namespace App\Service;

use App\Models\SentMessage;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class WaNotifService
{
    public static function getConfig()
    {
        return config('wasen');
    }

    public static function getToken()
    {
        return self::getConfig()['token'];
    }

    public static function getEndpoint()
    {
        return self::getConfig()['endpoint'];
    }

    public static function sendMessage($target, $message)
    {
        $endPoint = self::getEndpoint() . '/send';

        $headers = [
            'Authorization' => self::getToken()
        ];

        $options = [
            [
                'name' => 'target',
                'contents' => $target
            ],
            [
                'name' => 'message',
                'contents' => self::formatMessage($message)
            ]
        ];

        $response = Http::withHeaders($headers)
            ->asMultipart()
            ->post($endPoint, $options);

        return $response->body();
    }



    public static function formatMessage($message)
    {
        $message .= PHP_EOL;
        $message .= PHP_EOL;
        $message .= 'Dikirimkan pada tanggal ' . date('Y-m-d H:i:s') . ' oleh IoT Panel Arkatama';
        return $message;
    }



    public static function notifikasiSensor($user, $nilaiSensor, $jenisSensor)
    {
        $target = $user->phone_number;
        $name = $user->name;

        // Pesan berdasarkan jenis sensor
        switch ($jenisSensor) {
            case 'gas':
                $message = "Peringatan!" . PHP_EOL;
                $message .= "Halo $name, terdeteksi kebocoran gas  Nilai sensor: $nilaiSensor";
                break;
            case 'rain':
                $message = "Hujan" . PHP_EOL;
                $message .= "Halo $name, terdeteksi intensitas hujan tinggi  Nilai sensor: $nilaiSensor";
                break;
            case 'temperature':
                $message = "Suhu" . PHP_EOL;
                $message .= "Halo $name, terdeteksi suhu tinggi  Nilai suhu: $nilaiSensor";
                break;
            case 'humidity':
                $message = "Kelembaban" . PHP_EOL;
                $message .= "Halo $name, terdeteksi kelembaban tinggi  Nilai kelembaban: $nilaiSensor%";
                break;
            default:
                $message = "Peringatan!" . PHP_EOL;
                $message .= "Halo $name, terdeteksi nilai sensor tinggi  Nilai sensor: $nilaiSensor";
                break;
        }

        return self::sendMessage($target, $message);
    }



    public static function notifikasiSensorMassal($nilaiSensor, $jenisSensor)
    {
        // Nilai maksimal untuk berbagai sensor
        $nilaiMaksimal = [
            'mq' => 300,            // contoh nilai maksimal untuk sensor gas
            'rain' => 1,            // contoh nilai maksimal untuk sensor hujan
            'temperature' => 30,    // contoh nilai maksimal untuk suhu
            'humidity' => 32        // contoh nilai maksimal untuk kelembaban
        ];

        $durasiPesan = 1; // contoh dalam menit

        // ambil user role admin dan phone_number
        $users = User::where('role', 'admin')
            ->whereNotNull('phone_number')
            ->get();

        // cek kapan terakhir notifikasi dikirim untuk type sensor ini
        $lastSent = SentMessage::where('type', $jenisSensor)
            ->orderBy('created_at', 'desc')
            ->first();

        // jika nilai sensor lebih dari nilai maksimal sensor
        if ($nilaiSensor <= $nilaiMaksimal[$jenisSensor]) {
            return;
        }

        // jika belum pernah dikirim atau sudah lebih dari durasi pesan
        if (!$lastSent || now()->diffInMinutes($lastSent->created_at) >= $durasiPesan) {
            foreach ($users as $user) {
                self::notifikasiSensor($user, $nilaiSensor, $jenisSensor);
            }

            // simpan ke database
            SentMessage::create([
                'type' => $jenisSensor,
            ]);
        }
    }

}


// mengambil token dari config/wasender.php
// mengirimkan pesan ke nomor whatsapp
// notifikasi kebocoran gas
