@props(['url']) 
<tr> 
    <td class="header"> 
        <a href="{{ $url }}" style="display: inline-block;"> 
            @if (trim($slot) === 'Laravel') 
            <img src="https://raw.githubusercontent.com/RomanSola/MedStats/7c4f352a9e426b4e2896760ae5ccc954002cd447/logoSF.png" class="logo" alt="San Felipe Logo" style="width: 200px; height:auto; display:block; margin:auto;"> 
            @else {{ $slot }} 
            @endif 
        </a> 
    </td> 
</tr>