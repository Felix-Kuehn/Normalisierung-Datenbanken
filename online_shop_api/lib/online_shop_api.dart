import 'dart:convert';

import 'package:http/http.dart' as http;

void main(List<String> arguments) async {
  if (arguments.isEmpty) {
    print('Argumente fehlen');
    return;
  }

  if (arguments.length > 1) {
    print('Zu viele Argumente');
    return;
  }

  final table = arguments.first;
  final url = Uri.http('localhost', 'api.php', {'tabelle': table});
  final result = await http.get(url);
  if (result.statusCode != 200) {
    print('Fehler: ${result.statusCode}');
    return;
  }
  final json = jsonDecode(result.body);
  print(json);
}
