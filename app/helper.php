<?php






    function slug($str)
    {  
        $string = preg_replace("/[^a-z0-9_\s۰۱۲۳۴۵۶۷۸۹يءاأإآؤئبپتثجچحخدذرزژسشصضطظعغفقکكگگلمنوهی]/u", '', $str);
        
        $string = preg_replace("/[_\s]+/", ' ', $string);
        
        $string = preg_replace("/[_\s]/", '-', $string);
        
        return $string;
    }

    function uniqueSlug($slug,$table)
    {  
        $slug=trim($slug);
        
        $items=DB::table($table)->select('slug')->whereRaw("slug like '$slug%'")->get();

        if(sizeof($items)){
            foreach($items as $item){
                $data[] = $item->slug;
            }

            $count = 0;
            $slug_str=$slug;            
            while( in_array(($slug_str), $data) ){
                $slug_str = $slug . '-' . ++$count ; 
            }       
            return $slug_str;
        }
        
        return $slug;
    }


    function adsImageUpload($img)
    {
        
        $img_height = 700;
        $img_width = 700;
        $img_name=time().'-'.$img->getClientOriginalName();
        Image::make($img)->resize($img_width, $img_height)->save(base_path('/public/img/ads/'.$img_name));
        return "img/ads/" . $img_name;
        }

    function avatarImageUpload($img)
    {
        
        $img_height = 700;
        $img_width = 700;
        $img_name=time().'-'.$img->getClientOriginalName();
        Image::make($img)->resize($img_width, $img_height)->save(base_path('/public/img/avatars/'.$img_name));
        return "img/avatars/" . $img_name;
        }
    
    