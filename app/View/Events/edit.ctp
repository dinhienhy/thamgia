<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
    var map;
    var markers = [];
    var myCenter=new google.maps.LatLng(<?php echo $data['lat']; ?>,<?php echo $data['long']; ?>);
    
    function initialize()
    {
    var mapProp = {
      center:myCenter,
      zoom:13,
      mapTypeId:google.maps.MapTypeId.ROADMAP
      };
    
      map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
      var marker=new google.maps.Marker({
        position:myCenter,
      });
      marker.setMap(map);
      markers.push(marker);
    
      google.maps.event.addListener(map, 'click', function(event) {
        //Loop through all the markers and remove
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
        placeMarker(event.latLng);
      });
    }
    
    function placeMarker(location) {
      var marker = new google.maps.Marker({
        position: location,
        map: map,
      });
      var infowindow = new google.maps.InfoWindow({
        content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
      });
      infowindow.open(map,marker);
      //Add marker to the array.
      markers.push(marker);
      $('#lat').val(location.lat());
      $('#long').val(location.lng());
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php
    /*echo $this->Html->css('jquery-ui/smoothness/jquery-ui-1.8.22.custom'); */
    echo $this->Html->script('jquery.charsleft-0.1.js');
    echo $this->Html->script('jquery-ui-timepicker-addon.js');
    echo $this->Html->script('jquery-ui-sliderAccess.js');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#title").charsLeft({
            maxChars: 100,
            attachment: "after",
            charPrefix: "(Còn lại",
            charSuffix: "ký tự)"
        });
        $('#start').datetimepicker({dateFormat: 'dd/mm/yy'});
        $('#end').datetimepicker({dateFormat: 'dd/mm/yy'});
        
        $("#frm_add_event").validationEngine();
        
        $('#free').on('change', function(){
            if($(this).is(':checked')){
                $('#fee').attr('disabled', 'disabled');
            }
        });
        
        $('#not-free').on('change', function(){
            if($(this).is(':checked')){
                $('#fee').removeAttr('disabled');
            }
        });
        
        if($("#not-free").is(':checked')){
            $('#fee').removeAttr('disabled');
        }else{
            $('#fee').attr('disabled', 'disabled');   
        }
        
    });
    var defaultFeeValue = "<?php echo DEFAULT_FEE; ?>";
    var free = true;
    function feeFocus(){
        if ($('#fee').val() == defaultFeeValue){
            $('#fee').val('');
            $('#fee').attr('class', 'validate[required] text');
        }
    }
    
    function feeBlur(){
        if ($('#fee').val() == ''){
            $('#fee').val(defaultFeeValue);
            
            if (free){
                $('#fee').attr('class', 'text');
            }
                
        }
    }
    
    function freeClick(){
        free = true;
        $('#fee').attr('class', 'text');   
    }
    
    function notFreeClick(){
        free = false;
        $('#fee').attr('class', 'text');
    }
</script>

<?php 
    $cityId = isset($data['city_id']) ? $data['city_id'] : 0;
    $typeId = isset($data['type_id']) ? $data['type_id'] : 0;
    $careerId = isset($data['career_id']) ? $data['career_id'] : 0;    
    $free = isset($data['free']) ? $data['free'] : true;
    $fee = isset($data['fee']) ? $data['fee'] : DEFAULT_FEE;
?>

<?php if (isset($error)){?>
    <div class="error"><?php echo $error ?></div>
<?php } ?>
<h2 class="title title-center">Sửa sự kiện</h2>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="pt-block-business-card-left pt-block-business-card-center">
            <div class="pt-block-business-card-from">
                <form id="frm_add_event" name="frm_add_event" method="post" action="<?php echo $this->Html->url('/') ?>events/edit/<?php echo isset($data['id']) ? $data['id'] : '' ?>" class="login-subscription" enctype="multipart/form-data">
                    <input type="hidden" name="data[Event][user_id]" value="<?php echo $users_userid; ?>" />
                    <ul>
                        <li>
                            <label>Tên sự kiện</label>
    				        <input type="text" name="data[Event][title]" title="" value="<?php echo isset($data['title']) ? htmlentities($data['title'], ENT_QUOTES, 'UTF-8') : ''; ?>" class="validate[required] text" placeholder="Tên sự kiện">
                        </li>
                        <li>
    						<label>Địa điểm</label>
    						<input type="text" name="data[Event][address]" title="" value="<?php echo isset($data['address']) ? $data['address'] : ''; ?>" id="address" class="validate[required] text" placeholder="Địa điểm">
                            <div class="pt-select">
    							<i class="fa fa-angle-down"></i>
    							<select name="data[Event][city_id]">
                                    <?php foreach ($cities as $city) {?>
                                    <option value="<?php echo $city['City']['id']; ?>" <?php if ($city['City']['id'] == $cityId) echo 'selected="selected"'; ?> >
                                        <?php echo $city['City']['name']; ?>
                                    </option>
                                    <?php } ?>
    							</select>
    						</div>
    					</li>
    					<li class="w50">
    						<label>Ngày bắt đầu</label>
    						<div class="pt-datepicker">
    							<input readonly="true" name="data[Event][start]" id="start" class="span2 icon-input" placeholder="chọn" type="text" value="<?php echo isset($data['start']) ? $data['start'] : '' ?>">
    						</div>
    					</li>
    					<li class="w50">
    						<label>Ngày kết thúc</label>
    						<div class="pt-datepicker">
    							<input readonly="true" name="data[Event][end]" id="end" class="span2 icon-input" placeholder="chọn" type="text" value="<?php echo isset($data['end']) ? $data['end'] : '' ?>">
                                
    						</div>
    					</li>
    					<li class="w50">
    						<label>Thể loại</label>
    						<div class="pt-select">
    							<i class="fa fa-angle-down"></i>
    							<select name="data[Event][type_id]">
                                    <?php foreach ($types as $type) {?>
                                    <option value="<?php echo $type['Type']['id']; ?>"  <?php if ($type['Type']['id'] == $typeId) echo 'selected="selected"'; ?>>
                                        <?php echo $type['Type']['name']; ?>
                                    </option>
                                    <?php } ?>
    							</select>
    						</div>
    					</li>
    					<li class="w50">
    						<label>Lĩnh vực</label>
    						<div class="pt-select">
    							<i class="fa fa-angle-down"></i>
    							<select name="data[Event][career_id]">
                                    <?php foreach ($careers as $career) {?>
                                    <option value="<?php echo $career['Career']['id']; ?>"  <?php if ($career['Career']['id'] == $careerId) echo 'selected="selected"'; ?>>
                                        <?php echo $career['Career']['name']; ?>
                                    </option>
                                    <?php } ?>
    							</select>
    						</div>
    					</li>
    					<li class="pt-radio">
    						<label>Chi phí</label>
    						<input id="free" type="radio" name="data[Event][free]" title="" onclick="freeClick()" value="1" class="text" <?php if ($free) echo 'checked="checked"';?> id="is_free"/>
    						<span>Miễn phí</span>
    						<input id="not-free" type="radio" name="data[Event][free]" title="" onclick="notFreeClick()" value="0" class="text" <?php if (!$free) echo 'checked="checked"';?> id="is_subscribed4"/>
    						<span>Có tính phí</span>
                            <input type="text" name="data[Event][fee]" title="" id="fee" class="text" value="<?php echo $fee; ?>" 
                                    onfocus="feeFocus()" onblur="feeBlur()"/>
    					</li>
    					<li>
    						<label>Số điện thoại</label>
    						<input type="text" name="data[Event][hotline]" title="" value="<?php echo isset($data['hotline']) ? $data['hotline'] : '' ?>" class="text" placeholder="Nhập số điện thoại của bạn">
    					</li>
    					<li>
    						<label>Hình ảnh</label>
    						<input type="file" class="validate[required]" name="data[Event][image]"  id="FileImage">
    					</li>
                        <li>
                            <img alt="" style="float:left;" width="129" height="128" src="<?php echo $this->Html->url('/') .  (isset($data['image_url']) ? $data['image_url'] : '')  ?>" />
                        </li>
                        <li><label>Mô tả</label></li>
    					<li>
                            <?php echo $this->fck->ckeditor(array('Event', 'description'), $this->webroot, isset($data['description']) ? $data['description'] : ''); ?>
    					</li>
                        <li class="w50">
    						<label>Vĩ độ</label>
    						<div class="">
    							<input readonly="true" name="data[Event][lat]" id="lat" class="span2 icon-input" placeholder="Vĩ độ" type="text" value="<?php echo isset($data['lat']) ? $data['lat'] : '' ?>">
    						</div>
    					</li>
    					<li class="w50">
    						<label>Kinh độ</label>
    						<div class="">
    							<input readonly="true" name="data[Event][long]" id="long" class="span2 icon-input"  placeholder="Kinh độ" type="text" value="<?php echo isset($data['long']) ? $data['long'] : '' ?>">
    						</div>
    					</li>
                        <li>
                            <div id="googleMap" style="width:100%;height:380px;"></div>
    					</li>
    					<li>
    						<input type="submit" class="send" value="Cập nhật sự kiện">
    					</li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>


