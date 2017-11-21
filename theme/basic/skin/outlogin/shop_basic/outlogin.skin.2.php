<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);

// 쿠폰
$cp_count = 0;
$sql = " select cp_id
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."' ";
$res = sql_query($sql);

for($k=0; $cp=sql_fetch_array($res); $k++) {
    if(!is_used_coupon($member['mb_id'], $cp['cp_id']))
        $cp_count++;
}
?>

<!-- 로그인 후 아웃로그인 시작 { -->
<section id="ol_after" class="ol">
    <header id="ol_after_hd">
        <h2>나의 회원정보</h2>
        <span class="profile_img">
            <img src="<?php echo G5_THEME_IMG_URL ;?>/no_profile.gif" alt="프로필이미지">
            <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" id="ol_after_info"><i class="fa fa-cog" aria-hidden="true"></i><span class="sound_only">정보수정</span></a>
        </span>
        <strong><?php echo $nick ?>님</strong>
        <?php if ($is_admin == 'super' || $is_auth) {  ?><a href="<?php echo G5_ADMIN_URL ?>" class="btn_admin">관리자</a><?php }  ?>
    </header>
    <ul id="ol_after_private">
        <li>
            <a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" id="ol_after_memo" class="win_memo">
                <i class="fa fa-envelope-o" aria-hidden="true"></i> <span class="sound_only">안 읽은 쪽지</span>
                <strong><?php echo $memo_not_read ?></strong>
            </a>
        </li>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/point.php" target="_blank" id="ol_after_pt" class="win_point">
                <i class="fa fa-database" aria-hidden="true"></i> <span class="sound_only">포인트</span>
                <strong><?php echo $point ?></strong>
            </a>
        </li>

        <li>
            <a href="<?php echo G5_SHOP_URL ?>/coupon.php" target="_blank" id="ol_after_scrap" class="win_scrap"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span class="sound_only">쿠폰</span>
            <strong><?php echo number_format($cp_count); ?></strong>
            </a>
        </li>
    </ul>
    <footer id="ol_after_ft">
        <a href="<?php echo G5_BBS_URL ?>/logout.php" id="ol_after_logout" class="btn_b02">로그아웃</a>
    </footer>
</section>

<script>
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave()
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?"))
        location.href = "<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- } 로그인 후 아웃로그인 끝 -->
