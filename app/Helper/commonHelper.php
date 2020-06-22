<?php
namespace App\View\Helper;

/**
     * Description:  upload image. 
     * Function: fileUpload()
     * @author: Duy
     * @return   path image.
     * @version: 1.0
     */
function fileUpload(Request $request)

{

	$this->validate($request, [
		'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	]);
	$image = $request->file('image');
	$input['imagename'] = time().'.'.$image->getClientOriginalExtension();
	$destinationPath = public_path('/images');
	$image->move($destinationPath, $input['imagename']);

	return back()->with('success','Image Upload successful');

}
/**
     * Description: get curren date function.
     * Function: getDate()
     * @author: Duy
     * @param:  $time, $full_time  
     * @return   Curren date
     * @version: 1.0
     */
function getDate($time, $full_time = true)
{
	$fomat = '%d-%m-%Y';
	if($full_time)
	{
		$fomat = $fomat.' - %H:%i:%s';
	}
	$date = mdate($fomat , $time);
	return $date;
}
/**
     * Description: fotmat datetim d/m/y.
     * Function: formatDate() 
     * @author: Duy
     * @param:  datetime()  
     * @return   date (d/m/Y)
     * @version: 1.0
     */
function formatDate($datetime) {
	$date = date_create($datetime);
	return date_format($date, 'd/m/Y');
}
/**
     * Description: Create link path avatar company.
     * Function: pathCompany() 
     * @author: Duy
     * @param:  datetime()  
     * @return   date (d/m/Y)
     * @version: 1.0
     */
function  pathCompany()
{
    return 'files/avatar/company/';
}