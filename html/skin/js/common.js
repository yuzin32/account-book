function list_title_set(type){
var p = document.querySelector('p.mh-label');
    if(type=="in_list"){
        p.textContent = p.textContent.trim().replace(/^\[.*?\]/, '[입금]');
    }else if(type=="out_list"){
        p.textContent = p.textContent.trim().replace(/^\[.*?\]/, '[출금]');  
    }else if(type=="save_list"){
        p.textContent = p.textContent.trim().replace(/^\[.*?\]/, '[적금]');
    }else if(type=="loan_list"){
        p.textContent = p.textContent.trim().replace(/^\[.*?\]/, '[채무]');
    }
}
$(document).ready(function(){

    // tab
    $("ul.tab-btn li").click(function(){
        var thisTC = $(this).data('tab');
        $(".tab-con-wrap .tab-con").hide();
        $(".tab-con-wrap .tab-con." + thisTC).show();
        
        $("ul.tab-btn li").removeClass('on');
        $(this).addClass('on');
    });

    // password eyes
    $(".inp-pw a.pw-eyes").click(function(){
        if($(this).hasClass('show')){
            $(this).parent().find('input').attr('type','text');
            $(".inp-pw a.pw-eyes.show").hide();
            $(".inp-pw a.pw-eyes.hide").show();
        }
        else{
            $(this).parent().find('input').attr('type','password');
            $(".inp-pw a.pw-eyes.hide").hide();
            $(".inp-pw a.pw-eyes.show").show();
        }
    });


    //console.log("draggable 여부:", typeof $.fn.draggable);

    // ---------------------------------- modal 
    // 모달창 닫기
    $("div.modal-wrap a.modal-close").click(function(){
        $(this).parents("div.modal-wrap").hide();
        $(this).parents("div.modal-wrap").find("select").each(function(){
            $(this).prop('selectedIndex', 0);
        });
    });

    // 모달창 드래그(jquery ui)
    $("div.modal-wrap div.modal").draggable({
    handle: ".m-head" // header 영역으로만 드래그 가능
    });

    // 모달창 열기
    $(".modal-open").click(function(){
        var target = $(this).data('modal');
        $("div.modal-wrap." + target).show();

        if(target == "total-list"){
            //리스트 타입
            var type = $(this).data('type');
            $('input[name="list_type"]').val(type);
            list_title_set(type);

            // 처음 1페이지 데이터 로드 해당페이지에 데이터로드함수생성
            loadPage(1);
        }

    });

    
});

function checkAll(ch,form) {
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');

    // ★ 현재 체크박스 상태 확인
    const allChecked = ch.checked;
    console.log(allChecked);

    checkboxes.forEach(cb => {
        if (!allChecked) {
            cb.removeAttribute('checked'); // HTML 속성 제거
        } else {
            cb.setAttribute('checked', 'checked'); // HTML 속성
        }
    });
    
}


function find_maxnum(inputname) {

    let maxnum = null;
    const $inputs = $("input[name='" + inputname + "[]']");

    // input 자체가 없을 때
    if ($inputs.length === 0) {
        return 0;
    }

    $inputs.each(function () {
        const raw = $(this).val();
        if (raw === '') return;        // 빈 값 제외

        const val = Number(raw);
        if (isNaN(val)) return;        // 숫자 아닌 값 제외

        maxnum = (maxnum === null) ? val : Math.max(maxnum, val);
    });

    // 전부 비어있거나 숫자 없을 경우
    return maxnum ?? 0;
}
