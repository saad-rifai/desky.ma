
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
          <td>لم نتلقى منكم رداََ بخصوص طلبكم رقم {{ $content['OID'] }} "{{ $content['subject'] }}", نرجوا منكم ابلاغنا بردكم من أجل اتخاد اجراء بخصوص طلبكم 
            يمكنكم التواصل معنا عبر البريد الالكتروني support@moqawala.ma.
        </td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

<br>
{{ config('app.name') }}  شكرا لكم فريق, 

@endcomponent
