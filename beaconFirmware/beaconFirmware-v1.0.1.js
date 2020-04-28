io.press(() => {
        io.setLedColor("#FF77EB")
        io.led(1, true);

        location.startUpdates((position) => {

                    var data = {};

                    var ownId = sys.getPublicId();
                    print(`this beacon's ID: ${ownId}`);

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
                    data.lat=position.lat;
                    data.long=position.long;
                    data.speed=position.speed;
                    cloud.enqueue('beacon-test', data);
                    location.stop();
                    sync.now();
                    io.setLedColor("#FF77EB")
                    io.led(0, true);

            },
            {minInterval: 10}
        );

});
