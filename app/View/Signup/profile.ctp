<!-- File: /app/View/Signup/profile.ctp -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#frm_profile").validate();
        $('#fullname').rules('add', {
            required: true,
            maxlength: 25,
            messages: {
                required: "Vui lòng nhập họ tên",
                maxlength: "Họ tên tối đa 25 ký tự"
            }
        });
    });
    var currentDays = 31;
    
    function daysInMonth(month, year) {
        return new Date(year, month, 0).getDate();
    }
    
    function changeDay(){
        try{
            var year = $('#year').val();
            var month = $('#month').val();
            if (!isNaN(year) && !isNaN(month)){
                var newDay = daysInMonth(month, year);
                if (newDay != currentDays){
                    currentDays = newDay;
                    $('#day').empty();
                    var i=0;
                    $("#day").append('<option>Ngày</option>');
                    for(i=1; i<=currentDays; i++)
                        $("#day").append('<option value="'+ i + '">'+ i +'</option>');
                    $('#day').val('1');
                    $('.select-day .select').html('1');
                }   
            }
        }
        catch(ex){
            
        }
    }
</script>
<?php 
    $fullname ='';
    if (isset($data)){
        $fullname = $data['name'];
    }
    
    $hasError = true;   
    if (empty ($error))
        $hasError = false;
?>
<div class="registered-users">
    <h2 class="titel">ĐĂNG KÝ THÀNH VIÊN</h2>
    <?php if ($hasError){ ?>
    <div class="error"><?php echo $error ?></div>
    <?php } ?>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <form id="frm_profile" name="frm_profile" method="post" action="<?php echo $this->Html->url(array('controller' => 'signup', 'action' => 'profile')); ?>" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Họ Tên</label>
                    <div class="col-sm-9">
                        <input type="text" name="data[Profile][name]" title="" value="<?php echo $fullname; ?>" id="fullname" class="form-control" required="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Ngày Sinh</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="year" onchange="changeDay()" name="data[Profile][year]">
                            <option>Năm</option>
                            <?php 
                            for ($i=2015; $i>=1950; $i--){?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>    
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="month" onchange="changeDay()" name="data[Profile][month]">
                            <option>Tháng</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="7">07</option>
                            <option value="8">08</option>
                            <option value="9">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-sm-3 select-day">
                        <select class="form-control" id="day" name="data[Profile][day]">
                            <option>Ngày</option>
                            <?php 
                            for ($i=1; $i<=31; $i++){?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>    
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Đến Từ</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="city" name="data[Profile][city]">
                            <?php foreach ($cities as $city) {?>
                            <option value="<?php echo $city['City']['id']; ?>">
                                <?php echo $city['City']['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Lĩnh Vực Hoạt Động</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="career" name="data[Profile][career]">
                            <?php foreach ($careers as $career) {?>
                            <option value="<?php echo $career['Career']['id']; ?>">
                                <?php echo $career['Career']['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Hình Đại Diện</label>
                    <div class="col-sm-2">
                        <img src="<?php echo $this->Html->url('/'); ?>img/img-02.png" alt="Image">
                    </div>
                    <div class="col-sm-6">
                        <input class="form-control" type="file" name="data[Profile][avatar]"  id="FileImage" />
                        <span>Ảnh phải dưới 2M (jpg, png...)</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info">Tiếp Theo</button>
                        <button type="button" class="btn btn-info" onclick="$('#frm_profile')[0].reset(); return false;">Nhập Lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>

