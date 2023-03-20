method="POST" action="{{ route('employee.question.enquete') }}"



<tr>
                                        <td>
                                            <select name="questions_ids[]"
                                              data-te-select-init
                                              data-te-select-placeholder="Questions"
                                              multiple>
                                              <option value="`+questions[i]['id']+`">`+questions[i]['questions']+`</option>
                                            </select>
                                        </td>
                                    </tr>