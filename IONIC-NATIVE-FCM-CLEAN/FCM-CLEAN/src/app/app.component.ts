import { Component } from '@angular/core';

import { Platform } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import { FCM } from '@ionic-native/fcm/ngx';
import { LocalNotifications } from '@ionic-native/local-notifications/ngx';


@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss']
})
export class AppComponent {
  constructor(
    private localNotifications: LocalNotifications,
    private fcm: FCM,
    private platform: Platform,
    private splashScreen: SplashScreen,
    private statusBar: StatusBar
  ) {
    this.initializeApp();
  }

  initializeApp()
  {
    var id = 0;//id de la notifcación, solo usada en pruebas

    this.platform.ready().then(() =>
    {
      this.fcm.getToken().then(token => {
        console.log(token);
      });

      this.fcm.onTokenRefresh().subscribe(token => {
        console.log(token);
      });

      this.fcm.onNotification().subscribe(data => {
        console.log('noti',data);

        var result = data;   // get data in result variable
        var items = JSON.stringify(result); // then convert data to json string
        console.log(items);
        var allData = JSON.parse(items); // parse json data and pass json string


        if (data.wasTapped) {
          console.log('Received in background');

        }else{

          console.log('Received in foreground');
;
          id = id + 1;
          this.localNotifications.schedule({
            id: id,
            text: allData['body'],
            lockscreen: true,
            //sound: isAndroid? 'file://sound.mp3': 'file://beep.caf',
            //data: { secret: key }
          });
        };
      },error =>{
        alert("error is "+JSON.stringify(error));

      });

      //subscripciones a TOPICS
      //this.fcm.subscribeToTopic('people');
      //this.fcm.unsubscribeFromTopic('marketing');

      this.statusBar.styleDefault();
      this.splashScreen.hide();
    });
  }
}
