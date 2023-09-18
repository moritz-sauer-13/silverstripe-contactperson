<div class="content">
    <p class="mb-0">
        <%t ContactPerson.YOURCONTACTPERSON 'Ihr Ansprechpartner' %>
    </p>
    <% if $Title %>
        <span class="h3 bold <% if not $Phone && not $Mobile && not $Mail && not $Fax %> mb-0 <% end_if %>">
            $Title
        </span>
    <% end_if %>
    <% if $Phone || $Mobile || $Mail || $Fax %>
        <div class="mt-3 mt-md-4">
            <% if $Phone %>
                <a href="tel:$Phone" class="d-block">
                    <%t ContactPerson.PHONE 'Telefon' %>: $Phone
                </a>
            <% end_if %>
            <% if $Mobile %>
                <a href="tel:$Mobile" class="d-block">
                    <%t ContactPerson.MOBILE 'Mobil' %>: $Mobile
                </a>
            <% end_if %>
            <% if $Mail %>
                <a href="mailto:$Mail" class="d-block">
                    <%t ContactPerson.MAIL 'E-Mail' %>: $Mail
                </a>
            <% end_if %>
            <% if $Fax %>
                <span class="d-block">
                    <%t ContactPerson.FAX 'Fax' %>: $Fax
                </span>
            <% end_if %>
        </div>
    <% end_if %>
</div>