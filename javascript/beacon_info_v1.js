// on button press, compile a system/status report about the current LTE beacon,
// and send it to Estimote Cloud


// REST API EndPoint URL: https://cloud.estimote.com/v3/lte/device_events?app_id=yjFaxdjn4z&app_release=0




io.press(() => {
    var data = {};

    var ownId = sys.getPublicId();
    print(`this beacon's ID: ${ownId}`);
    // beacon's ID is already included when sending data to Estimote Cloud
    //data.ownId = ownId;

    var time = new Date();
    print(`time: ${time.toString()}`);
    data.time = time.getTime(); // milliseconds since epoch

    var temperature = sensors.temp.get();
    print(`temperature: ${temperature.toFixed(2)} deg. C`);
    data.temperature = temperature;

    var uptime = sys.getUptime();
    print(`uptime: ${uptime} seconds (` +
        `in minutes: ${(uptime / 60).toFixed(1)}; ` +
        `in hours: ${(uptime / 3600).toFixed(1)}; ` +
        `in days: ${(uptime / 86400).toFixed(1)})`);
    data.uptime = uptime;

    var firmwareVersion = sys.getFirmware();
    var firmwareVersionString = `${firmwareVersion[0]}.${firmwareVersion[1]}.${firmwareVersion[2]}`;
    print(`firmware version: ${firmwareVersionString}`);
    data.firmwareVersion = firmwareVersionString;

    var batteryPercent = sensors.battery.getPerc();
    print(`battery level: ${batteryPercent}%`);
    data.batteryPercent = batteryPercent;

    var batteryVoltage = sensors.battery.getVoltage();
    print(`battery voltage: ${batteryVoltage.toFixed(4)}`);
    data.batteryVoltage = batteryVoltage;

    var externalPower = sensors.battery.isExtPower();
    print(`beacon connected to external power: ${externalPower}`);
    data.externalPower = externalPower;

    var charging = sensors.battery.isCharging();
    print(`beacon is charging: ${charging}`);
    data.charging = charging;

    var acc  = sensors.imu.getAccel();
    print(`beacon is : ${acc}`);
    data.acc = acc;


    // upload all this info to Estimote Cloud
    cloud.enqueue('beacon-test', data);
    sync.now();

});
