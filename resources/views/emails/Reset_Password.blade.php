@component('mail::message')
<div style="direction: rtl; text-align: right">
    <table>
      <thead>
        <tr>
          <th>مرحبا !</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>أنت تتلقى هذا البريد الإلكتروني لأننا تلقينا طلب إعادة تعيين كلمة المرور لحسابك. <br>
            @component('mail::button', ['url' => '{{ route('password.reset', $content['token']) }}'])
            اعادة تعيين كلمة السر
            @endcomponent
        <br>
        <br>
        إذا لم تطلب إعادة تعيين كلمة المرور ، فلا داعي لاتخاذ أي إجراء آخر.
          </td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

<br>
   شكرا لكم فريق, {{ config('app.name') }}

@endcomponent
