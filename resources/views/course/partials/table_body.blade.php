@forelse ($courses as $course)
    <tr>
        <td>
            <input type="checkbox"
                   name="selected_courses[]"
                   value="{{ $course->id }}"
                   class="checkbox-modern course-checkbox"
                   {{ in_array($course->id, session('selected_courses', [])) ? 'checked' : '' }}>
        </td>
        <td>
            @php $department = $departments->where('id', $course->dep_id)->first(); @endphp
            @if($department)
                <span class="badge-modern badge-primary">{{ $department->name }}</span>
            @else
                <span style="color: #adb5bd; font-size: 0.8rem;">—</span>
            @endif
        </td>
        <td>
            @php $subject = $subjects->where('id', $course->subject_id)->first(); @endphp
            @if($subject)
                <span style="font-weight: 600;">{{ $subject->name }}</span>
            @else
                <span style="color: #adb5bd; font-size: 0.8rem;">—</span>
            @endif
        </td>
        <td>
            <span style="font-weight: 700; color: #667eea; font-family: monospace;">
                {{ $course->coursenumber }}
            </span>
        </td>
        <td>
            @if($course->page_number)
                <span class="badge-modern badge-success">
                    <i class="fas fa-file-alt"></i> {{ $course->page_number }}
                </span>
            @else
                <span style="color: #adb5bd;">—</span>
            @endif
        </td>
        <td>
            @if($course->start_date)
                <span style="display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fas fa-calendar-alt" style="color: #667eea; font-size: 0.7rem;"></i>
                    {{ $course->start_date }}
                </span>
            @else
                <span style="color: #adb5bd;">—</span>
            @endif
        </td>
        <td>
            @if($course->days_of_course)
                @php $days = explode(',', $course->days_of_course); @endphp
                @foreach($days as $day)
                    <span class="day-tag-modern">{{ trim($day) }}</span>
                @endforeach
            @else
                <span style="color: #adb5bd;">—</span>
            @endif
        </td>
        <td>
            <div style="display: flex; flex-wrap: wrap; gap: 5px; justify-content: center;">
                @can('تفاصيل دورة')
                <a href="{{ route('showcourse', ['id' => $course->id]) }}" class="table-action-btn view-btn">
                    <i class="fas fa-eye"></i> تفاصيل
                </a>
                @endcan
                @can('تعديل دورة')
                <a href="{{ route('editcourse', ['id' => $course->id]) }}" class="table-action-btn edit-btn">
                    <i class="fas fa-edit"></i> تعديل
                </a>
                @endcan
                <button class="table-action-btn delete-btn delete-course" data-id="{{ $course->id }}">
                    <i class="fas fa-trash-alt"></i> حذف
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8">
            <div class="empty-state-modern">
                <i class="fas fa-inbox"></i>
                <h5>لا توجد دورات مطابقة</h5>
                <p>حاول تعديل معايير البحث</p>
            </div>
        </td>
    </tr>
@endforelse