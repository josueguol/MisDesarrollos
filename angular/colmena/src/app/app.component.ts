import { Component } from '@angular/core';
import { state, trigger, style, transition, animate } from '@angular/animations';
import { fadeIn } from './animations/fade.animation'

@Component({
  selector: 'Colmena-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
  animations: [
    trigger('rigthPanel', [
      state('close', style({
        right: '-100%'
      })),
      state('open', style({
        right: '0px'
      })),
      transition('close => open', animate('600ms linear')),
      transition('open => close', animate('600ms linear'))
    ]),
    fadeIn
  ]
})

export class AppComponent {
  title = 'Colmena';
  version = 'polaris';
  sideNavStatus;
  profileStatus;
  notificationStatus;
  settingStatus;
  applicationStatus;
  currentProject = 'Azteca Deportes';
  projectFlow = 'Producción'
  projectSelectStatus = false;
  
  
  constructor(){
    this.sideNavStatus = false;
    this.profileStatus = 'close';
    this.notificationStatus = 'close';
    this.settingStatus = false;
    this.applicationStatus = false;
  }

  /* Abre la barra principal de navegación */
  sidenav() {
    if ( this.sideNavStatus == false ) {
      this.sideNavStatus = true;
      this.profileStatus = 'close';
      this.notificationStatus = 'close';
      this.settingStatus = false;
      this.applicationStatus = false;
    } else {
      this.sideNavStatus = false;
    }
  }
  
  /* Abre el panel de  */
  profile(status) {
    if (this.profileStatus == 'close' ) {
      this.profileStatus = 'open' ;
      this.notificationStatus = 'close';
      this.settingStatus = false;
      this.applicationStatus = false;
    } else {
      this.profileStatus = 'close';
    }
  }

  /* Abre el panel de notificaciones */
  notification(status) {
    if (this.notificationStatus == 'close' ) {
      this.notificationStatus = 'open' ;
      this.profileStatus = 'close';
      this.settingStatus = false;
      this.applicationStatus = false;
      this.sideNavStatus = false;
    } else {
      this.notificationStatus = 'close';
    }
  }

  /* Abre la ventana de configuarción */
  settings(){
    if (this.settingStatus == false ) {
      this.settingStatus = true;
      this.sideNavStatus = false;
      this.profileStatus = 'close';
      this.notificationStatus = 'close';
      this.applicationStatus = false;
    } else {
      this.settingStatus = false;
    }
  }

  /* Abre el panel de las aplicaciones */
  application() {
    if (this.applicationStatus == false ) {
      this.applicationStatus = true;
      this.notificationStatus = 'close';
      this.profileStatus = 'close';
      this.sideNavStatus = false;
    } else {
      this.applicationStatus = false;
    }
  }

  /* Funcion para el selector de proyectos */
  selectProject() {
    if (this.projectSelectStatus == false ) {
      this.projectSelectStatus = true;
    } else {
      this.projectSelectStatus = false;
    }
  }  
}
