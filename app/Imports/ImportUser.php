<?php

namespace App\Imports;

use App\Models\User;
use App\Models\User_image;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use App\Library\Services\UserService;

class ImportUser implements ToModel, WithStartRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }  /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $count = 1;
    public function model(array $row)
    {
        $user = User::create([
            'first_name'  => $row[0] ,
            'middle_name'  => $row[1],
            'last_name'  => $row[2],
            'mobile'  => $row[3],
            'state'  => $row[4],
            'city'  => $row[5],
            'address'  => $row[6],
        ]);

        $spreadsheet = IOFactory::load(request()->file('file'));
        $i = 0;
        foreach ($spreadsheet->getActiveSheet()->getDrawingCollection() as $drawing) {
            
            if ($drawing instanceof MemoryDrawing) {
                ob_start();
                call_user_func(
                    $drawing->getRenderingFunction(),
                    $drawing->getImageResource()
                );
                $imageContents = ob_get_contents();
                ob_end_clean();
                switch ($drawing->getMimeType()) {
                    case MemoryDrawing::MIMETYPE_PNG :
                        $extension = 'png';
                        break;
                    case MemoryDrawing::MIMETYPE_GIF:
                        $extension = 'gif';
                        break;
                    case MemoryDrawing::MIMETYPE_JPEG :
                        $extension = 'jpg';
                        break;
                }
            } else {
                if ($drawing->getPath()) {
                    // Check if the source is a URL or a file path
                    if ($drawing->getIsURL()) {
                        $imageContents = file_get_contents($drawing->getPath());
                        $filePath = tempnam(sys_get_temp_dir(), 'Drawing');
                        file_put_contents($filePath , $imageContents);
                        $mimeType = mime_content_type($filePath);
                        $extension = File::mime2ext($mimeType);
                        unlink($filePath);            
                    }
                    else {
                        $zipReader = fopen($drawing->getPath(),'r');
                        $imageContents = '';
                        while (!feof($zipReader)) {
                            $imageContents .= fread($zipReader,1024);
                        }
                        fclose($zipReader);
                        $extension = $drawing->getExtension();            
                    }
                }
            }
        
            $myFileName = time() .'-'.++$i. '.' . $extension;
           
            $userImage = User_image::where('user_id', $user->id)->first();
            if($this->count === $i){
                file_put_contents('images/users/' . $myFileName, $imageContents);
                User_image::create([
                    'user_id' => $user->id,
                    'image_name' => $myFileName,
                   ]);  
            }       
    }
    $this->count++;
    }
    
}
