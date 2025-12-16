<form name="join_form" action="join_call.php" method="POST">
<input type='hidden' name='smode' id="smode" value='<?=$smode?>' >

<div class="join-warp">
	<div class="form-wrap join">
		<div class="form">
			<div class="tit">이름</div>
			<div class="con">
				<input type="text" name="name" placeholder="이름">
			</div>
		</div>
		<div class="form">
			<div class="tit">아이디</div>
			<div class="con">
				<div class="row">
					<input type="text" id="userid" name="userid" placeholder="아이디">
					<a class="form-btn" id="id_chk" onclick="id_chk()" href="#none">중복체크</a>
				</div>
			</div>
		</div>
		<div class="form">
			<input type='hidden' id="pw_chk" value="">
			<div class="tit">비밀번호</div>
			<div class="con">
				<div class="inp-pw">
					<input type="password" name="input_pw" oninput="pwcheck(this.value)"; placeholder="비밀번호">
					<a href="#none" class="pw-eyes show" title="비밀번호 보기"></a>
            		<a href="#none" class="pw-eyes hide" title="비밀번호 숨김" style="display:none;"></a>
				</div>
				<ul class="pwd-chk-list">
					<li id="pw_chk1" >특수문자</li>
					<li id="pw_chk2" >숫자 포함</li>
					<li id="pw_chk3" >10자 이상</li>
				</ul>
			</div>
		</div>
		<div class="form">
			<div class="tit">이메일</div>
			<div class="con">
				<input type="text" name="email" placeholder="이메일">
			</div>
		</div>
		<div class="form">
			<div class="tit">전화번호</div>
			<div class="con">
				<input type="text" name="tel_mobile" placeholder="전화번호">
			</div>
		</div>
		<div class="btn-center-wrap">
			<a href="#none" class="c-btn cancel --lg">취소</a>
			<!--<a href="#none" class="c-btn confirm">확인</a>-->
			<a href="javascript://" class="c-btn confirm --lg" onclick="data_save('join_form')" >확인</a>
		</div>
	</div>
</div>
 </form>

 <script type="text/javascript">
function id_chk(){
	$.ajax({
    type: "post",
    url: "join_chk.php",
    data: { inputID: $("#userid").val() },
    dataType: "json",  // 응답은 JSON
    success: function(res) {
        alert(res.message); // JSON 키 접근
    },
    error: function(xhr, status, error) {
        console.log("에러:", error);
        console.log("응답:", xhr.responseText);
    }
});
	}
function pwcheck(password) {
	const inputPw = document.getElementById("pw_chk"); // 비밀번호 input
  const checks = [
    { test: /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/, id: "pw_chk1" }, // 특수문자
    { test: /[0-9]/, id: "pw_chk2" },  // 숫자
    { test: /.{10,}/, id: "pw_chk3" }  // 길이 10 이상
  ];
  // 모든 조건 충족 여부 추적
  let allPassed = true;
  checks.forEach(({ test, id }) => {
    const el = document.getElementById(id);
    if (test.test(password)) {
      el.classList.add("chked");
    } else {
      el.classList.remove("chked"); // 조건 안 맞으면 제거까지
	  allPassed=false;
    }
  });
  if(allPassed===false){
	inputPw.value = "n"; }else{inputPw.value = "y";}
}
</script>