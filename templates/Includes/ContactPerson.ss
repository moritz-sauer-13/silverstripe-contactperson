<% if $currentContactTeamMember && $ShowContactPerson %>
<% require themedCSS('client/scss/_contactperson') %>
<% require javascript('moritz-sauer-13/contactperson:client/js/contactperson.js') %>
    <% with $currentContactTeamMember %>
        <div id="contactperson" class="contactperson typography $ExtraClass">
            <div class="contactperson__icon">
                <% if $Image %>
                    <img src="$Image.FocusFill(80,80).Link" class="img-fluid" alt="$Title">
                    <svg class="d-none" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
                <% else %>
                    <img src="" class="img-fluid d-none" alt="$Title">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
                <% end_if %>
            </div>
            <div class="contactperson__content">
                <% include ContactPersonSearch %>
                <% include ContactPersonContent %>
            </div>
        </div>
    <% end_with %>
<% end_if %>