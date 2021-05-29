
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
            <td>نعلمكم أن طلبكم رقم {{ $content['OID'] }} المتعلق بي {{ $content['subject'] }} في انتضار الدفع ندعوكم الى دفع تكلفة خدمتكم من خلال تحويل بنكي للحساب التالي: {{$content['RIB']}} وارسال وصل الأداء عبر البريد الالكتروني التالي support@moqawala.ma من أجل تلبية طلبكم  في أقرب وقت</td>
            <td></td>
        </tr>
      </tbody>
    </table>
  </div>

<br>
   شكرا لكم فريق, {{ config('app.name') }}

@endcomponent
