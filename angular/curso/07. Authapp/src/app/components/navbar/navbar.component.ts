import { Component, OnInit } from '@angular/core';

import { AuthService } from '../../services/auth.service';


@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styles: []
})
export class NavbarComponent {

  icon = "fa-stroopwafel";

  constructor( private auth: AuthService ) { 
    auth.handleAuthentication();
  }

  login(){
    this.auth.login();
  }

  logout(){
    this.auth.logout();
  }
}
