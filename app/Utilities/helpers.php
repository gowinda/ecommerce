<?php
use App\Models\Category;
function getCategoryMenu(){
    $category = new Category();
    $category = $category->where('status','active')->where('parent_id',null)->with('child_cats')->orderBy('title','ASC')->get();
    if($category){
        ?>
        <li>
            <a href="" class="dropbtn">Category</a>

            <ul class="dropdown">
                <?php
                    foreach ($category as $parent_cats){
                        if($parent_cats->child_cats->count() > 0){
                            ?>
                            <li style="width: 223px;"><a href="#"><?php echo $parent_cats->title ?></a>
                                <ul class="dropdown-subcontent">
                                    <?php
                                    foreach ($parent_cats->child_cats as $child_category){
                                        ?>
                                        <li>
                                            <a href="<?php echo route('sub-cat-product',[$parent_cats->slug, $child_category->slug])?>">
                                                <?php echo $child_category->title?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li style="width: 223px">
                                <a href="<?php echo route('cat-product',$parent_cats->slug)?>">
                                    <?php echo $parent_cats->title ?>
                                </a>
                            </li>
                            <?php
                        }
                    }
                ?>

            </ul>
        </li>
        <?php
    }

}

function deleteImage($image_name, $dir){
    $path = public_path().'/uploads/'.$dir;

    if($image_name != null && file_exists($path.'/'.$image_name)){
        unlink($path.'/'.$image_name);
    }
    if($image_name != null && file_exists($path.'/Thumb-'.$image_name)){
        unlink($path.'/Thumb-'.$image_name);
    }
}

function uploadImage($file, $dir, $thumb = null){
    $path = public_path().'/uploads/'.$dir;
    if(!File::exists($path)){
        File::makeDirectory($path, 0777, true, true);
    }

    $image_name = ucfirst($dir)."-".date('Ymdhis').rand(0,9999).".".$file->getClientOriginalExtension();
    $success = $file->move($path, $image_name);
    if ($success){
        if($thumb){
            list($width,$height) = explode('x',$thumb); //1200x780
            Image::make($path.'/'.$image_name)->resize($width,$height,function($constraint){
                return $constraint->aspectRatio();
            })->save($path.'/Thumb-'.$image_name);
        }
        return $image_name;
    }else{
        return false;
    }
}
