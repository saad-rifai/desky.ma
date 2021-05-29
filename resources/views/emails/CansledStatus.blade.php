
@component('mail::message')




<div style="direction: rtl; text-align: right">
    <table>
      <thead>
        <tr>
          <th>مرحبا سيد(ة)  {{$content['name']}},</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>نعلمكم أنه تم الغاء طلبكم رقم {{ $content['OID'] }} "{{ $content['subject'] }}" في حال كنت تظن أنه هناك خطأ ما يرجى التواصل معنا عبر support@moqawala.ma</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

<br>
   شكرا لكم فريق, {{ config('app.name') }}

@endcomponent
