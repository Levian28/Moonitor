<!doctype html>
<html lang="id">
<body style="margin:0;padding:24px;background:#e9eef3;font-family:Arial,Helvetica,sans-serif;color:#18232f;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
    <tr><td align="center">
      <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="max-width:480px;background:#ffffff;border:1px solid #cdd6df;border-radius:12px;padding:32px;">
        <tr><td>
          <h1 style="margin:0 0 12px;font-size:22px;">Atur ulang PIN</h1>
          <p style="margin:0 0 24px;line-height:1.5;">Kami menerima permintaan untuk mengatur ulang PIN akun Anda. Tautan ini berlaku {{ $expiresInMinutes }} menit.</p>
          <p style="margin:0 0 24px;">
            <a href="{{ $resetUrl }}" style="display:inline-block;padding:12px 24px;background:#3f5bff;color:#ffffff;text-decoration:none;border-radius:8px;font-weight:bold;">Buat PIN baru</a>
          </p>
          <p style="margin:0 0 8px;font-size:13px;color:#5d6b79;">Jika tombol tidak berfungsi, salin tautan ini ke browser:</p>
          <p style="margin:0 0 24px;font-size:13px;word-break:break-all;"><a href="{{ $resetUrl }}" style="color:#3f5bff;">{{ $resetUrl }}</a></p>
          <p style="margin:0;font-size:13px;color:#5d6b79;">Bukan Anda yang meminta? Abaikan email ini, PIN Anda tidak berubah.</p>
        </td></tr>
      </table>
    </td></tr>
  </table>
</body>
</html>
