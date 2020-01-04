<?php
  $tmp_txt = '';
  if($this->session->userdata('user_level')=='super_user') {
    $this->load->model("common_model");
    $rows = $this->common_model->custom_query("select * from users where fag_allow='allow' and user_level='user'");
    $tmp_txt = "<center><select id='user_select' style='margin-top:5px;'><option>เลือก User</option>";
    foreach ($rows as $key => $value) {
      $selected = "";
      if($this->session->userdata('user_id')==$value['user_id']) {
        $selected = "selected";
      }
      $tmp_txt = $tmp_txt."<option {$selected} value='{$value['user_id']}'>{$value['user_fname']}</option>";
    }
    $tmp_txt = $tmp_txt."</select></center>";
  }
?>

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <?php 
          echo $tmp_txt;
        ?>
        <ul class="nav">

    <?php if($this->session->userdata('user_level')=='admin'){ ?>
          <li class="nav-item <?php if($this->uri->segment(1)=='' || $this->uri->segment(1)=='dashboard'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">หน้าหลัก</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='blogdata' && $this->uri->segment(2)=='blog'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}blogdata/blog">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">ข่าว/บทความ</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='selffood' && $this->uri->segment(2)=='self_food_menu'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}selffood/self_food_menu">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">ข้อมูลเมนูปรุงเอง(ระบบ)</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='shopdata' && $this->uri->segment(2)=='shops'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}shopdata/shops">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">จัดการร้านอาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='setting' && $this->uri->segment(2)=='users'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}setting/users">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">จัดการผู้ใช้งาน</span>
            </a>
          </li>
        <?php
        }
        ?>

        <?php if($this->session->userdata('user_level')=='user' || $this->session->userdata('user_level')=='super_user'){ ?>
          
          <li class="nav-item <?php if($this->uri->segment(1)=='dashboard_user'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}dashboard_user">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">หน้าหลัก</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(2)=='users' && $this->uri->segment(3)=='edit'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}setting/users/edit/<?php echo $this->session->userdata('encrypt_user_id');?>">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">จัดการข้อมูลส่วนตัว</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(2)=='users_result_exam_chemical'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}exam/users_result_exam_chemical">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">ผลตรวจสุขภาพทางทางชีวเคมี</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(2)=='users_result_exam_food_allergy'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}exam/users_result_exam_food_allergy">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">ผลตรวจการแพ้อาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='foodallergy' && $this->uri->segment(2)=='users_foood_allergy'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}foodallergy/users_foood_allergy">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">ข้อมูลอาหารที่ท่านแพ้</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='drugeat' && $this->uri->segment(2)=='users_drug'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}drugeat/users_drug">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">ข้อมูลยาที่ทานประจำ</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='foodeat' && $this->uri->segment(2)=='users_food_time'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}foodeat/users_food_time">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">ข้อมูลการรับประทานอาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='selffood' && $this->uri->segment(2)=='self_food_menu'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}selffood/self_food_menu">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">ข้อมูลเมนูปรุงเอง</span>
            </a>
          </li>
          <?php
          }
          ?>

          <?php if($this->session->userdata('user_level')=='shop'){ ?>
          <li class="nav-item <?php if($this->uri->segment(1)=='dashboard_res'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}dashboard_res">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">หน้าหลัก</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='shopdata' && $this->uri->segment(2)=='shops'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}shopdata/shops/edit/<?php echo $this->session->userdata('encrypt_shop_id');?>">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">ข้อมูลร้านอาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='restaurant' && $this->uri->segment(2)=='shop_food_menu'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}restaurant/shop_food_menu">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">เมนูอาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(2)=='shop_promotions' && $this->uri->segment(3)=='editpro'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}restaurant/shop_promotions/editpro">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">โปรโมชั่น</span>
            </a>
          </li>

          <?php
          }
          ?>
          
          <li class="nav-item">
            <a class="nav-link" href="{site_url}user_login/destroy">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>


        </ul>
      </nav>