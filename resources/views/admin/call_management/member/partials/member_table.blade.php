<table class="table table-bordered table-hover table-sm">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Membership No</th>
            <th>Name</th>
            <th>Father / Husband</th>
            <th>Address</th>
            <th>Post</th>
            <th>State</th>
            <th>District</th>
            <th>Pincode</th>
            <th>Mobile</th>
            <th>WhatsApp</th>

            <th>Ayushmati Name</th>
            <th>Ayushmati Age</th>
            <th>Ayushmati Qualification</th>
            <th>Father Occupation</th>
            <th>Father/Husband Name</th>
            <th>Marriage Month</th>
            <th>Marriage Year</th>

            <th>Sister 1 Name</th>
            <th>Sister 1 Qualification</th>
            <th>Sister 1 Age</th>

            <th>Sister 2 Name</th>
            <th>Sister 2 Qualification</th>
            <th>Sister 2 Age</th>

            <th>Sister 3 Name</th>
            <th>Sister 3 Qualification</th>
            <th>Sister 3 Age</th>

            <th>Expected Package</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Card Type</th>
            <th>Card Price</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($members as $key => $member)
            <tr>
                <td>{{ $members->firstItem() + $key }}</td>
                <td>{{ $member->membership_number }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->father_husband }}</td>
                <td>{{ $member->address }}</td>
                <td>{{ $member->post }}</td>
                <td>{{ $member->state }}</td>
                <td>{{ $member->district }}</td>
                <td>{{ $member->pincode }}</td>
                <td>{{ $member->mobile }}</td>
                <td>{{ $member->whatsapp }}</td>

                <td>{{ $member->ayushmati_girl_name }}</td>
                <td>{{ $member->ayushmati_age }}</td>
                <td>{{ $member->ayushmati_qualification }}</td>
                <td>{{ $member->ayushmati_father_occupation }}</td>
                <td>{{ $member->ayushmati_father_husband_name }}</td>
                <td>{{ $member->ayushmati_expected_marriage_month }}</td>
                <td>{{ $member->ayushmati_expected_marriage_year }}</td>

                <td>{{ $member->sister_name_1 }}</td>
                <td>{{ $member->sister_qualification_1 }}</td>
                <td>{{ $member->sister_age_1 }}</td>

                <td>{{ $member->sister_name_2 }}</td>
                <td>{{ $member->sister_qualification_2 }}</td>
                <td>{{ $member->sister_age_2 }}</td>

                <td>{{ $member->sister_name_3 }}</td>
                <td>{{ $member->sister_qualification_3 }}</td>
                <td>{{ $member->sister_age_3 }}</td>

                <td>{{ $member->expected_marriage_package }}</td>
                <td>{{ $member->added_date }}</td>
                <td>
                    <span class="badge {{ $member->status ? 'bg-success' : 'bg-danger' }}">
                        {{ $member->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>{{ $member->card_type }}</td>
                <td>{{ $member->card_price }}</td>
                <td>
                    <button class="btn btn-sm btn-primary openCallModal" data-id="{{ $member->id }}"
                        data-name="{{ $member->name }}" data-bs-toggle="modal" data-bs-target="#callRemarkModal">
                        Add Call Remark
                    </button>


                    <a href="{{ route('admin.call.details', $member->id) }}" class="btn btn-sm btn-info">
                        Call Details
                    </a>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="32" class="text-center text-danger">
                    No members found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $members->links() }}
</div>