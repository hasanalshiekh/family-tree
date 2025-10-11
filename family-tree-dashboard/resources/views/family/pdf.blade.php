<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شجرة عائلة {{ $family->name }}</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: white;
            direction: rtl;
            text-align: right;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin: 0;
            font-weight: bold;
        }
        
        .header p {
            color: #666;
            font-size: 16px;
            margin: 10px 0 0 0;
        }
        
        .tree-container {
            width: 100%;
            margin: 20px 0;
        }
        
        .generation {
            margin: 30px 0;
            text-align: center;
        }
        
        .generation-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .members-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }
        
        .member-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 15px;
            text-align: center;
            min-width: 200px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .member-card.generation-2 {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        
        .member-card.generation-3 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .member-card.generation-4 {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        }
        
        .member-card.generation-5 {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        }
        
        .member-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .member-gender {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .member-relationship {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 5px;
        }
        
        .member-age {
            font-size: 12px;
            opacity: 0.8;
        }
        
        .family-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-right: 5px solid #667eea;
        }
        
        .family-info h3 {
            color: #2c3e50;
            margin: 0 0 10px 0;
        }
        
        .family-info p {
            margin: 5px 0;
            color: #666;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e9ecef;
            color: #666;
            font-size: 12px;
        }
        
        .tree-lines {
            position: relative;
            height: 20px;
            margin: 10px 0;
        }
        
        .line {
            position: absolute;
            height: 2px;
            background: #667eea;
            top: 50%;
            transform: translateY(-50%);
        }
        
        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
            
            .member-card {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>شجرة عائلة {{ $family->name }}</h1>
        @if($family->description)
            <p>{{ $family->description }}</p>
        @endif
        <p>تم إنشاؤها في: {{ now()->format('Y/m/d H:i') }}</p>
    </div>
    
    <div class="family-info">
        <h3>معلومات العائلة</h3>
        <p><strong>عدد الأعضاء:</strong> {{ $members->count() }} عضو</p>
        <p><strong>عدد الأجيال:</strong> {{ $members->max('generation') ?? 0 }} أجيال</p>
        <p><strong>تاريخ الإنشاء:</strong> {{ $family->created_at->format('Y/m/d') }}</p>
        <p><strong>آخر تحديث:</strong> {{ $family->updated_at->format('Y/m/d') }}</p>
    </div>
    
    @if($members->count() > 0)
        @foreach($members->groupBy('generation') as $generation => $generationMembers)
        <div class="generation">
            <div class="generation-title">
                الجيل {{ $generation }}
            </div>
            
            <div class="members-row">
                @foreach($generationMembers as $member)
                <div class="member-card generation-{{ $member->generation }}">
                    <div class="member-name">
                        {{ $member->getDisplayName() }}
                    </div>
                    <div class="member-gender">
                        @if($member->gender === 'male')
                            ♂ ذكر
                        @else
                            ♀ أنثى
                        @endif
                    </div>
                    @if($member->relationship)
                        <div class="member-relationship">
                            {{ $member->relationship }}
                        </div>
                    @endif
                    @if($member->getAge())
                        <div class="member-age">
                            {{ $member->getAge() }} سنة
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
        
        <!-- Family Tree Structure -->
        <div class="family-info">
            <h3>هيكل الشجرة العائلية</h3>
            @foreach($members->groupBy('generation') as $generation => $generationMembers)
                <div style="margin: 15px 0;">
                    <strong>الجيل {{ $generation }}:</strong>
                    @foreach($generationMembers as $member)
                        <span style="background: #e9ecef; padding: 5px 10px; margin: 2px; border-radius: 15px; display: inline-block;">
                            {{ $member->getDisplayName() }}
                            @if($member->relationship)
                                ({{ $member->relationship }})
                            @endif
                        </span>
                    @endforeach
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <h3>لا توجد أعضاء في العائلة بعد</h3>
            <p>سيتم إضافة أعضاء العائلة قريباً</p>
        </div>
    @endif
    
    <div class="footer">
        <p>تم إنشاء هذه الشجرة باستخدام نظام شجرة العائلة - Family Tree Dashboard</p>
        <p>رابط المشاركة: {{ request()->getSchemeAndHttpHost() }}/share/{{ $family->share_token }}</p>
    </div>
</body>
</html>
