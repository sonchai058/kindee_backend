      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item <?php if($this->uri->segment(1)=='' || $this->uri->segment(1)=='dashboard'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">[admin] หน้าหลัก</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='blogdata' || $this->uri->segment(1)=='blog'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}blogdata/blog">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">[admin] ข่าว/บทความ</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='selffood' || $this->uri->segment(1)=='self_food_menu'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}selffood/self_food_menu">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">[admin] ข้อมูลเมนูปรุงเอง</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='shopdata' || $this->uri->segment(1)=='shops'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}shopdata/shops">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">[admin] จัดการร้านอาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='setting' || $this->uri->segment(1)=='users'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}setting/users">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">[admin] จัดการผู้ใช้งาน</span>
            </a>
          </li>
          
          <li class="nav-item <?php if($this->uri->segment(1)=='dashboard_user'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}dashboard_user">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">[user] หน้าหลัก</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='users' || $this->uri->segment(1)=='edit'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}setting/users/edit/ODVoNG5wUjhqZjNBd0pXYWdvQlgwQT09">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">[user] จัดการข้อมูลส่วนตัว</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='exam' || $this->uri->segment(1)=='users_result_exam_chemical'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}exam/users_result_exam_chemical">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">[[user] ผลตรวจสุขภาพทางทางชีวเคมี</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='exam' || $this->uri->segment(1)=='users_result_exam_food_allergy'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}exam/users_result_exam_food_allergy">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">[[user] ผลตรวจการแพ้อาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='foodallergy' || $this->uri->segment(1)=='users_foood_allergy'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}foodallergy/users_foood_allergy">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">[user] ข้อมูลอาหารที่ท่านแพ้ (เคยตรวจ)</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='foodallergy' || $this->uri->segment(1)=='user_novisit'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}foodallergy/user_novisit/edit/czFxdVREYk1yZURNalE2SmZld2ZJQT09">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">[user] ข้อมูลอาหารที่ท่านแพ้ (ไม่เคยตรวจ)</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='drugeat' || $this->uri->segment(1)=='users_drug'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}drugeat/users_drug">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">[user] ข้อมูลยาที่ทานประจำ</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='foodeat' || $this->uri->segment(1)=='users_food_time'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}foodeat/users_food_time">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">[user] ข้อมูลการรับประทานอาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='dashboard_res'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}dashboard_res">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">[restaurant] หน้าหลัก</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='shopdata' || $this->uri->segment(1)=='shops'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}shopdata/shops/edit/aTNDREt5Y01QYS9ySDRkS3c2WXhZdz09">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">[restaurant] ข้อมูลร้านอาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='restaurant' || $this->uri->segment(1)=='shop_food_menu'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}restaurant/shop_food_menu">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">[restaurant] เมนูอาหาร</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='restaurant' || $this->uri->segment(1)=='shop_promotions'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}restaurant/shop_promotions/edit/bGlzRVkvYWxuS0pRRjJIdXg5L3UzQT09">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">[restaurant] โปรโมชั่น</span>
            </a>
          </li>

          <li class="nav-item <?php if($this->uri->segment(1)=='restaurant' || $this->uri->segment(1)=='shop_promotions'){?>active<?php }?>">
            <a class="nav-link" href="{site_url}restaurant/shop_promotions/edit/bGlzRVkvYWxuS0pRRjJIdXg5L3UzQT09">
              <i class="mdi mdi-login menu-icon"></i>
              <span class="menu-title">Login</span>
            </a>
          </li>

        </ul>
      </nav>