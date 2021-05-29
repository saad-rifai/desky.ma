
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
          <td>نعلمكم أنه قد حاولنا التواصل معكم من خلال الرقم التالي {{$content['phonenumber']}} بشأن طلبكم رقم {{$content['OID']}} "{{$content['subject']}}" ولم نتلقى رداََ,
            نرجوا منكم اعلامنا بالوقت المناسب لاعادة الاتصال بكم مجدداََ, في حال كان رقم الهاتف خاطئاََ برجى ارسال رقم الهاتف الخاص بكم.</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

<br>
   شكرا لكم فريق, {{ config('app.name') }}

@endcomponent
