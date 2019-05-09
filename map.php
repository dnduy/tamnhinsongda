<div id="home_search">
  <form method="post">
    <div id="box_search_map" align="center">
    <table border="0" cellpadding="0" cellspacing="10">
    <tbody><tr>
      <td width="200"><select name="slphuong" id="slphuong" onchange="setBDSPhuong2(this.value);">
          <option value="">Phường</option>
                    <option value="phuong-1">Phường 1</option>
                    <option value="phuong-3" selected="">Phường 3</option>
                    <option value="phuong-4">Phường 4</option>
                    <option value="phuong-5">Phường 5</option>
                    <option value="phuong-6">Phường 6</option>
                    <option value="phuong-7">Phường 7</option>
                    <option value="phuong-8">Phường 8</option>
                    <option value="phuong-9">Phường 9</option>
                    <option value="phuong-10">Phường 10</option>
                    <option value="phuong-11">Phường 11</option>
                    <option value="phuong-12">Phường 12</option>
                    <option value="phuong-13">Phường 13</option>
                    <option value="phuong-14">Phường 14</option>
                    <option value="phuong-15">Phường 15</option>
                    <option value="phuong-16">Phường 16</option>
                    <option value="phuong-17">Phường 17</option>
                  </select></td>
      <td width="300"><select name="slduong" id="slduong">
          <option value="">Đường</option>
        </select></td>
      <td width="300"><select name="slbdsprice" id="slbdsprice">
          <option value="">Mức Giá</option>
                    <option value="duoi-5-trieu">Dưới 5 triệu</option>
                    <option value="5-trieu-10-trieu">5 triệu đến 10 triệu</option>
                    <option value="10-trieu-30-trieu">10 triệu đến 30 triệu</option>
                    <option value="30-trieu-100-trieu">30 triệu đến 100 triệu</option>
                    <option value="100-trieu-500-trieu">100 triệu đến 500 triệu</option>
                    <option value="500-trieu-1-ty">500 triệu đến 1 tỷ</option>
                    <option value="1-ty-1-5-ty">1 tỷ đến 1,5 tỷ</option>
                    <option value="1-5-ty-2-ty">1,5 tỷ đến 2 tỷ</option>
                    <option value="2-ty-den-3-ty">2 tỷ đến 3 tỷ</option>
                    <option value="3-ty-5-ty">3 tỷ đến 5 tỷ</option>
                    <option value="tren-5-ty">Trên 5 tỷ</option>
                  </select></td>
      <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Tìm kiếm"></td>
    </tr>
    </tbody></table>
    </div>
  </form>
</div>


<div class="content_map">
<div id="map"></div>
<div class="right_map">
<div class="right_title">Danh sách bất động sản</div>
<hr>
<ul id="list"></ul>
</div>
</div>


<script>
	function resizeMap(){
		h=window.innerHeight-($("#home_search").height()+$(".dnw-nav").height());
		$(".content_map").height(h);
	}
	resizeMap();
	function setBDSPhuong2(val)
{
	$.ajax({
        type: "GET",
        url: "ajax/getmapduong.php",
        data: "id="+val,
        success: function(msg){
			$("#slduong").html(msg);
			$("#slduong").selectbox('detach').selectbox();

        },
		error:function(msg){
		hctalert(msg);	
        }
    });
}

$(this).resize(function(e) {
	resizeMap();
});
</script>