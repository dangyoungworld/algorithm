<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 5/28/2016
 * Time: 9:53
 */
class Files
{
    /**
     * LẤY TẤT CẢ CÁC FILE VÀ FOLDER TRONG MỘT THƯ MỤC BẤT KỲ
     * Giải quyết bài toán này chúng ta có thể dùng để zip một folder, làm chương trình quản lý file giống manager file của trình quản lý panel host
     * Thuật toán sử dụng giải thuật đệ quy để vét cạn tất cả các file
     */
    public function zip_folder($folder_source = '')
    {
        $arr_files = $this->arr_file_folder($folder_source);
        $file_name = 'Backup_'.date('Y_m_d_h_i',time()).'.zip';
        $zip = new ZipArchive();
        if ($zip->open($file_name,ZipArchive::CREATE | ZipArchive::OVERWRITE ) != true)
        {
            die('Cannot open file '.$file_name);
        }
        foreach($arr_files as $k => $v)
        {
            $zip->addFile($v);
        }
        $zip->close();

        return $file_name;
    }

    //    Hàm này sẽ loại bỏ 2 file name là . và .. khi sử dụng hàm scandir
    public function strip_file($array = array(), $files = array('.','..','.DS_Store'))
    {
        if(empty($files))
        {
            return false;
        }
        return array_diff($array,$files);
    }

    public function arr_file_folder($folder_source = '')
    {
        $arr_file = array();
//        Câu lệnh is_dir kiểm tra giúp ta đây có phải là một folder hay không
        if( ! is_dir($folder_source))
        {
            return false;
        }

        $list_file = $this->strip_file(scandir($folder_source));
        foreach($list_file as $k => $v)
        {
            if(is_file($folder_source.'/'.$v))
            {
                $arr_file[] = $folder_source.'/'.$v;
            }
            if(is_dir($folder_source.'/'.$v))
            {
                //Gọi đệ quy để tạo 1 folder file có đầy đủ các file trong folder đó
                $arr_file = array_merge($arr_file,$this->arr_file_folder($folder_source.'/'.$v));
            }

        }
        return $arr_file;
    }
}