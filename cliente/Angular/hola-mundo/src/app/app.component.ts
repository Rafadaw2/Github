import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.css'
})
export class AppComponent {
  public title:string = 'hola pedro';
  public mensaje:string = 'Tu contraseña es ';
  public contrasena:number = 5485323;
  public contador:number = 20;

  incrementar():void{
    this.contador++;
  }
  decrementar():void{
    this.contador--;
  }
}
