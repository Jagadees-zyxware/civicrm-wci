{*<h3>This new page is generated by CRM/Wci/Page/ProgressBarList.php</h3> *}

{* Example: Display a variable directly 
<p>The current time is {$currentTime}</p>
*}
{* Example: Display a translated string -- which happens to include a variable 
<p>{ts 1=$currentTime}(In your native language) The current time is %1.{/ts}</p>
*}

{*
    {capture assign=newPageURL}{crmURL p='civicrm/admin/contribute/add' q='action=add&reset=1'}{/capture}
    <div id="help">
       {ts}CiviContribute allows you to create and maintain any number of Online Contribution Pages. You can create different pages for different programs or campaigns - and customize text, amounts, types of information collected from contributors, etc.{/ts} {help id="id-intro"}
    </div>

    {include file="CRM/Contribute/Form/SearchContribution.tpl"}
    {if NOT ($action eq 1 or $action eq 2) }
      <table class="form-layout-compressed">
      <tr>
      <td><a href="{$newPageURL}" class="button"><span><div class="icon add-icon"></div>{ts}Add Contribution Page{/ts}</span></a></td>
            <td style="vertical-align: top"><a class="button" href="{crmURL p="civicrm/admin/pcp" q="reset=1"}"><span>{ts}Manage Personal Campaign Pages{/ts}</span></a> {help id="id-pcp-intro" file="CRM/PCP/Page/PCP.hlp"}</td>
      </tr>
      </table>
    {/if}
*}
    {if $rows}
      <div id="configure_contribution_page">
             {strip}

       {include file="CRM/common/pager.tpl" location="top"}
             {include file="CRM/common/pagerAToZ.tpl"}
       {include file="CRM/common/jsortable.tpl"}
             <table id="options" class="display">
               <thead>
               <tr>
                 <th id="sortable">{ts}Name{/ts}</th>
               <th>{ts}Goal Amout{/ts}</th>
            <th></th>
               </tr>
               </thead>
               {foreach from=$rows item=row}
                 <tr id="row_{$row.id}" >   {* class="{if NOT $row.is_active} disabled{/if}" *}
                     <td><strong>{$row.name}</strong></td>
                     <td>{$row.goal_amount}</td>
          <td class="crm-contribution-page-actions right nowrap">

       {if $row.configureActionLinks}
         <div class="crm-contribution-page-configure-actions">
                  {$row.configureActionLinks|replace:'xx':$row.id}
         </div>
             {/if}

            {if $row.contributionLinks}
        <div class="crm-contribution-online-contribution-actions">
                  {$row.contributionLinks|replace:'xx':$row.id}
        </div>
        {/if}

        {if $row.onlineContributionLinks}
        <div class="crm-contribution-search-contribution-actions">
                  {$row.onlineContributionLinks|replace:'xx':$row.id}
        </div>
        {/if}

        <div class="crm-contribution-page-more">
                    {$row.action|replace:'xx':$row.id}
            </div>

      </td>

         </tr>
         {/foreach}
      </table>

        {/strip}
      </div>
    {else}
  {if $isSearch eq 1}
      <div class="status messages">
                <img src="{$config->resourceBase}i/Inform.gif" alt="{ts}status{/ts}"/>
                {capture assign=browseURL}{crmURL p='civicrm/contribute/manage' q="reset=1"}{/capture}
                    {ts}No available Contribution Pages match your search criteria. Suggestions:{/ts}
                    <div class="spacer"></div>
                    <ul>
                    <li>{ts}Check your spelling.{/ts}</li>
                    <li>{ts}Try a different spelling or use fewer letters.{/ts}</li>
                    <li>{ts}Make sure you have enough privileges in the access control system.{/ts}</li>
                    </ul>
                    {ts 1=$browseURL}Or you can <a href='%1'>browse all available Contribution Pages</a>.{/ts}
      </div>
      {else}
      <div class="messages status no-popup">
             <div class="icon inform-icon"></div> &nbsp;
             {ts 1=$newPageURL}No Progressbars have been created yet. Click <a accesskey="N" href='%1'>here</a> to create a new Progressbar.{/ts}
      </div>
        {/if}
    {/if}
